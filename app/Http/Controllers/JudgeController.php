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
        $judgeId = Auth::id();

        // Get all verified and non-disqualified photos
        $photos = Photo::where('is_disqualified', false)
            ->where('verification_status', 'Verified')
            ->with(['scores' => function($query) use ($judgeId) {
                $query->where('judge_id', $judgeId);
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        // Group by category
        $categories = $photos->groupBy('category');

        $totalPhotos = $photos->count();
        
        // Count photos that have at least one score from this judge
        $judgedCount = $photos->filter(function($photo) {
            return $photo->scores->isNotEmpty();
        })->count();
        
        $pendingCount = $totalPhotos - $judgedCount;

        return view('judge.dashboard', compact('categories', 'judgedCount', 'totalPhotos', 'pendingCount'));
    }

    public function judgeNext()
    {
        $judgeId = Auth::id();

        // Query for unjudged AND verified photos
        $query = Photo::where('is_disqualified', false)
            ->where('verification_status', 'Verified')
            ->whereDoesntHave('scores', function ($query) use ($judgeId) {
                $query->where('judge_id', $judgeId);
            });

        // If skipping, get the next ID
        if (request()->has('skip_id')) {
            $query->where('id', '>', request()->skip_id);
        }

        $photo = $query->first();

        // If skipped and reached the end, loop back to the beginning
        if (!$photo && request()->has('skip_id')) {
             $photo = Photo::where('is_disqualified', false)
                ->where('verification_status', 'Verified')
                ->whereDoesntHave('scores', function ($query) use ($judgeId) {
                    $query->where('judge_id', $judgeId);
                })->first();
        }

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

        if ($photo->verification_status !== 'Verified') {
            return redirect()->route('judge.dashboard')->with('error', 'This photo is not verified yet.');
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

    public function myScores(Request $request)
    {
        $judgeId = Auth::id();
        $query = Photo::whereHas('scores', function($q) use ($judgeId) {
            $q->where('judge_id', $judgeId);
        })->with(['scores' => function($q) use ($judgeId) {
            $q->where('judge_id', $judgeId)->with('criteria');
        }]);

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        if ($request->has('date') && $request->date != '') {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('participant_name', 'like', "%{$search}%")
                  ->orWhere('village', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%");
            });
        }
        
        $perPage = $request->get('per_page', 20);
        $photos = $query->orderBy('created_at', 'desc')->paginate($perPage)->appends($request->query());

        return view('judge.scores', compact('photos'));
    }
}
