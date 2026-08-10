<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Report;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_photos' => Photo::count(),
            'smartphone' => Photo::where('category', 'smartphone')->count(),
            'dslr' => Photo::where('category', 'dslr')->count(),
            'judged' => Photo::has('scores')->count(),
            'pending' => Photo::doesntHave('scores')->count(),
            'reported' => Report::where('status', 'pending')->count(),
            'disqualified' => Photo::where('is_disqualified', true)->count(),
            'unique_participants' => Photo::whereNotNull('whatsapp')->where('whatsapp', '!=', '')->distinct('whatsapp')->count('whatsapp'),
            'new_today' => Photo::whereDate('created_at', now()->toDateString())->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function results(Request $request)
    {
        $category = $request->get('category', 'smartphone');
        
        // For final results, we want photos that have been judged and are not disqualified
        $photos = Photo::where('is_disqualified', false)
            ->where('category', $category)
            ->whereHas('scores')
            ->with(['scores.criteria', 'scores.judge'])
            ->get();

        // Calculate average scores
        foreach ($photos as $photo) {
            $totalWeightedScore = 0;
            $judgeCount = $photo->scores->groupBy('judge_id')->count();

            if ($judgeCount > 0) {
                // Group scores by criteria to apply weights
                $scoresByCriteria = $photo->scores->groupBy('criteria_id');
                
                foreach ($scoresByCriteria as $criteriaId => $scores) {
                    $criteria = $scores->first()->criteria;
                    $avgScoreForCriteria = $scores->avg('score');
                    $totalWeightedScore += $avgScoreForCriteria;
                }
            }

            $photo->final_score = $totalWeightedScore;
        }

        // Sort by final score (desc), then by Criteria 1 (desc), then by created_at (asc)
        $photos = $photos->sort(function ($a, $b) {
            // 1. Compare Final Score (descending)
            if ($a->final_score !== $b->final_score) {
                return $b->final_score <=> $a->final_score; // desc
            }
            
            // 2. Compare score of Criteria ID 1 (descending)
            $scoreA = $a->scores->where('criteria_id', 1)->avg('score') ?? 0;
            $scoreB = $b->scores->where('criteria_id', 1)->avg('score') ?? 0;
            if ($scoreA !== $scoreB) {
                return $scoreB <=> $scoreA; // desc
            }
            
            // 3. Compare created_at (ascending)
            $timeA = $a->created_at ? $a->created_at->timestamp : 0;
            $timeB = $b->created_at ? $b->created_at->timestamp : 0;
            return $timeA <=> $timeB; // asc (earlier is preferred)
        })->values();

        // Paginate the collection
        $page = $request->get('page', 1);
        $perPage = 20;
        $paginatedPhotos = new \Illuminate\Pagination\LengthAwarePaginator(
            $photos->forPage($page, $perPage),
            $photos->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.results', [
            'photos' => $paginatedPhotos,
            'category' => $category,
            'total' => $photos->count()
        ]);
    }

    public function reports(Request $request)
    {
        $status = $request->get('status', 'pending');
        $query = Report::with(['photo', 'judge'])->where('status', $status);
        
        $reports = $query->orderBy('created_at', 'desc')->paginate(20);
        
        $stats = [
            'pending' => Report::where('status', 'pending')->count(),
            'resolved' => Report::where('status', 'resolved')->count(),
            'dismissed' => Report::where('status', 'dismissed')->count(),
        ];
        
        return view('admin.reports', compact('reports', 'status', 'stats'));
    }

    public function resolveReport(Request $request, Report $report)
    {
        $action = $request->get('action'); // 'disqualify' or 'dismiss'
        
        if ($action === 'disqualify') {
            $report->update(['status' => 'resolved']);
            $report->photo->update([
                'is_disqualified' => true,
                'verification_notes' => "Reason: Disqualified from Judge Report (" . $report->reason . ")\n" . $report->notes,
                'verification_status' => 'Disqualified' // Also update status just in case
            ]);
            return back()->with('success', 'Photo has been disqualified based on the report.');
        } else {
            $report->update(['status' => 'dismissed']);
            return back()->with('success', 'Report dismissed. Photo remains active.');
        }
    }

    public function resetSystem(Request $request)
    {
        // Require the exact string confirmation
        $confirmation = $request->input('confirmation');
        if ($confirmation !== 'HAPUS SEMUA DATA') {
            return back()->with('error', 'Konfirmasi tidak valid. Sistem gagal direset.');
        }

        // Disable foreign key checks temporarily to allow truncating
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate tables to reset IDs to 1
        \App\Models\Score::truncate();
        \App\Models\Report::truncate();
        \App\Models\Photo::truncate();
        
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return back()->with('success', 'SEMUA DATA PESERTA BERHASIL DIHAPUS. Sistem telah direset ke kondisi awal.');
    }

    public function exportResults(Request $request)
    {
        $category = $request->get('category', 'smartphone');
        
        $photos = Photo::where('is_disqualified', false)
            ->where('category', $category)
            ->whereHas('scores')
            ->with(['scores.criteria', 'scores.judge'])
            ->get();

        // Calculate average scores
        foreach ($photos as $photo) {
            $totalWeightedScore = 0;
            $judgeCount = $photo->scores->groupBy('judge_id')->count();

            if ($judgeCount > 0) {
                $scoresByCriteria = $photo->scores->groupBy('criteria_id');
                foreach ($scoresByCriteria as $criteriaId => $scores) {
                    $totalWeightedScore += $scores->avg('score');
                }
            }
            $photo->final_score = $totalWeightedScore;
        }

        // Sort by final score (desc), then by Criteria 1 (desc), then by created_at (asc)
        $photos = $photos->sort(function ($a, $b) {
            if ($a->final_score !== $b->final_score) {
                return $b->final_score <=> $a->final_score; // desc
            }
            $scoreA = $a->scores->where('criteria_id', 1)->avg('score') ?? 0;
            $scoreB = $b->scores->where('criteria_id', 1)->avg('score') ?? 0;
            if ($scoreA !== $scoreB) {
                return $scoreB <=> $scoreA; // desc
            }
            $timeA = $a->created_at ? $a->created_at->timestamp : 0;
            $timeB = $b->created_at ? $b->created_at->timestamp : 0;
            return $timeA <=> $timeB; // asc (earlier is preferred)
        })->values();

        $filename = "Hasil_Penjurian_Kasiinfo_" . ucfirst($category) . "_" . date('Ymd_His') . ".csv";

        $headers = [
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($photos) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel to open it correctly
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // CSV Header
            fputcsv($file, [
                'Peringkat', 
                'Judul Foto', 
                'Nama Peserta', 
                'Kategori', 
                'Desa', 
                'Kecamatan', 
                'Perangkat', 
                'Nilai Kriteria 1 (Tema & Narasi)', 
                'Nilai Kriteria 2 (Komposisi)', 
                'Nilai Kriteria 3 (Teknis)', 
                'Nilai Kriteria 4 (Dampak Emosional)', 
                'Nilai Akhir', 
                'Catatan Juri', 
                'Waktu Upload'
            ]);

            // CSV Data
            foreach ($photos as $index => $photo) {
                $rank = $index + 1;
                $c1 = $photo->scores->where('criteria_id', 1)->avg('score') ?? 0;
                $c2 = $photo->scores->where('criteria_id', 2)->avg('score') ?? 0;
                $c3 = $photo->scores->where('criteria_id', 3)->avg('score') ?? 0;
                $c4 = $photo->scores->where('criteria_id', 4)->avg('score') ?? 0;
                
                $notes = $photo->scores->pluck('notes')->filter()->unique()->implode('; ');

                fputcsv($file, [
                    $rank,
                    $photo->title,
                    $photo->participant_name,
                    strtoupper($photo->category),
                    $photo->village,
                    $photo->district,
                    $photo->device_used ?? 'Tidak Terdeteksi',
                    number_format($c1, 2),
                    number_format($c2, 2),
                    number_format($c3, 2),
                    number_format($c4, 2),
                    number_format($photo->final_score, 2),
                    $notes,
                    $photo->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
