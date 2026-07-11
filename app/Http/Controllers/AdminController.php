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

        // Sort by final score descending
        $photos = $photos->sortByDesc('final_score')->values();

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

}
