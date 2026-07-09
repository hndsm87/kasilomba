<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Criteria;
use App\Models\Score;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JudgeController extends Controller
{
    public function dashboard()
    {
        $judge = Auth::user();

        // Get count of photos judged by this judge
        $judgedCount = Score::where('judge_id', $judge->id)->distinct('photo_id')->count('photo_id');
        
        // Get total photos available for judging (not disqualified)
        $totalPhotos = Photo::where('is_disqualified', false)->count();
        
        $pendingCount = $totalPhotos - $judgedCount;

        return view('judge.dashboard', compact('judgedCount', 'totalPhotos', 'pendingCount'));
    }

    public function judgeNext()
    {
        $judgeId = Auth::id();

        // Find the first photo that is not disqualified and hasn't been judged by this judge yet
        $photo = Photo::where('is_disqualified', false)
            ->whereDoesntHave('scores', function ($query) use ($judgeId) {
                $query->where('judge_id', $judgeId);
            })
            ->first();

        if (!$photo) {
            return redirect()->route('judge.dashboard')->with('success', 'You have successfully judged all available photos!');
        }

        return redirect()->route('judge.photo', $photo->id);
    }

    public function judgePhoto(Photo $photo)
    {
        if ($photo->is_disqualified) {
            return redirect()->route('judge.next')->with('error', 'This photo has been disqualified.');
        }

        $criterias = Criteria::where('is_active', true)
            ->whereIn('category', ['all', $photo->category])
            ->orderBy('order')
            ->get();

        // Check if judge already scored this
        $existingScores = Score::where('photo_id', $photo->id)
            ->where('judge_id', Auth::id())
            ->get()
            ->keyBy('criteria_id');

        return view('judge.interface', compact('photo', 'criterias', 'existingScores'));
    }

    public function storeScore(Request $request, Photo $photo)
    {
        $request->validate([
            'scores' => 'required|array',
            'scores.*' => 'required|numeric|min:0|max:100',
            'notes' => 'nullable|string'
        ]);

        $judgeId = Auth::id();

        DB::transaction(function () use ($request, $photo, $judgeId) {
            foreach ($request->scores as $criteriaId => $scoreValue) {
                $score = Score::updateOrCreate(
                    [
                        'photo_id' => $photo->id,
                        'judge_id' => $judgeId,
                        'criteria_id' => $criteriaId,
                    ],
                    [
                        'score' => $scoreValue,
                        'notes' => $request->notes
                    ]
                );
            }
        });

        // Automatically redirect to the next unjudged photo
        return redirect()->route('judge.next');
    }

    public function reportPhoto(Request $request, Photo $photo)
    {
        $request->validate([
            'reason' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        Report::create([
            'photo_id' => $photo->id,
            'judge_id' => Auth::id(),
            'reason' => $request->reason,
            'notes' => $request->notes,
        ]);

        return redirect()->route('judge.next')->with('success', 'Photo flagged for administrative review.');
    }

    public function myScores()
    {
        $scores = Score::where('judge_id', Auth::id())
            ->with(['photo', 'criteria'])
            ->get()
            ->groupBy('photo_id');

        return view('judge.scores', compact('scores'));
    }
}
