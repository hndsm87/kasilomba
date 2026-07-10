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
        // For final results, we want photos that have been judged and are not disqualified
        $photos = Photo::where('is_disqualified', false)
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
                    $totalWeightedScore += $avgScoreForCriteria * ($criteria->weight / 100);
                }
            }

            $photo->final_score = $totalWeightedScore;
        }

        // Sort by final score descending
        $photos = $photos->sortByDesc('final_score')->values();

        return view('admin.results', compact('photos'));
    }

    public function criteria()
    {
        $criterias = \App\Models\Criteria::orderBy('order')->get();
        return view('admin.criteria', compact('criterias'));
    }
}
