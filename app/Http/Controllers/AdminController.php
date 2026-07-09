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
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function results()
    {
        // Get all approved photos with their average scores
        $photos = Photo::where('is_disqualified', false)
            ->with(['scores.criteria'])
            ->get()
            ->map(function ($photo) {
                $totalScore = 0;
                foreach ($photo->scores as $score) {
                    $totalScore += $score->score * ($score->criteria->weight / 100);
                }
                
                // If there are multiple judges, we average the total score
                $judgeCount = $photo->scores->pluck('judge_id')->unique()->count();
                $finalScore = $judgeCount > 0 ? $totalScore / $judgeCount : 0;
                
                $photo->final_score = $finalScore;
                return $photo;
            })
            ->sortByDesc('final_score')
            ->values();

        return view('admin.results', compact('photos'));
    }
}
