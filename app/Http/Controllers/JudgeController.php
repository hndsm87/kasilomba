<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Criteria;
use App\Models\Score;
use App\Models\Report;
use App\Models\JudgeCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JudgeController extends Controller
{
    public function dashboard(Request $request)
    {
        $judgeId = Auth::id();

        // Get all verified and non-disqualified photos
        $query = Photo::where('is_disqualified', false)
            ->where('verification_status', 'Verified')
            ->with(['scores' => function($query) use ($judgeId) {
                $query->where('judge_id', $judgeId);
            }]);

        // Filter by Category
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Filter by Collection
        if ($request->has('collection_id') && $request->collection_id != '') {
            $query->whereHas('judgeCollections', function($q) use ($request, $judgeId) {
                $q->where('judge_collections.id', $request->collection_id)
                  ->where('judge_collections.judge_id', $judgeId);
            });
        }

        // Filter by Status (Judged vs Pending)
        if ($request->has('status') && $request->status != '') {
            if ($request->status === 'judged') {
                $query->whereHas('scores', function($q) use ($judgeId) {
                    $q->where('judge_id', $judgeId);
                });
            } elseif ($request->status === 'pending') {
                $query->whereDoesntHave('scores', function($q) use ($judgeId) {
                    $q->where('judge_id', $judgeId);
                });
            }
        }

        $photos = $query->orderBy('created_at', 'desc')->get();

        // Group by category
        $categories = $photos->groupBy('category');

        // Total metrics (these remain global for status cards)
        $totalPhotosQuery = Photo::where('is_disqualified', false)->where('verification_status', 'Verified');
        $totalPhotos = $totalPhotosQuery->count();
        $judgedCount = $totalPhotosQuery->whereHas('scores', function($q) use ($judgeId) {
            $q->where('judge_id', $judgeId);
        })->count();
        $pendingCount = $totalPhotos - $judgedCount;

        // Fetch collections for dropdown
        $judgeCollections = JudgeCollection::where('judge_id', $judgeId)->orderBy('name')->get();

        return view('judge.dashboard', compact('categories', 'judgedCount', 'totalPhotos', 'pendingCount', 'judgeCollections'));
    }

    public function judgeNext()
    {
        $judgeId = Auth::id();

        // Query for unjudged AND verified photos
        $query = Photo::where('is_disqualified', false)
            ->where('verification_status', 'Verified')
            ->whereDoesntHave('scores', function ($query) use ($judgeId) {
                $query->where('judge_id', $judgeId);
            })
            ->whereDoesntHave('reports', function ($query) use ($judgeId) {
                $query->where('judge_id', $judgeId)->where('status', '!=', 'dismissed');
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
                })
                ->whereDoesntHave('reports', function ($query) use ($judgeId) {
                    $query->where('judge_id', $judgeId)->where('status', '!=', 'dismissed');
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

        // Fetch collections for this judge and get active collection IDs for this photo
        $judgeCollections = Auth::user()->judgeCollections()->orderBy('name')->get();
        $activeCollectionIds = $photo->judgeCollections()
            ->where('judge_id', Auth::id())
            ->pluck('judge_collections.id')
            ->toArray();

        return view('judge.interface', compact('photo', 'criterias', 'existingScores', 'judgeCollections', 'activeCollectionIds'));
    }

    public function storeScore(Request $request, Photo $photo)
    {
        $request->validate([
            'scores' => 'required|array',
            'scores.*' => 'required|numeric|min:0',
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
        }, 'judgeCollections' => function($q) use ($judgeId) {
            $q->where('judge_id', $judgeId);
        }]);

        // Filter by collection
        if ($request->has('collection_id') && $request->collection_id != '') {
            $query->whereHas('judgeCollections', function($q) use ($request, $judgeId) {
                $q->where('judge_collections.id', $request->collection_id)
                  ->where('judge_collections.judge_id', $judgeId);
            });
        }

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

        // Get collections for this judge
        $judgeCollections = JudgeCollection::where('judge_id', $judgeId)
            ->withCount('photos')
            ->orderBy('name')
            ->get();

        return view('judge.scores', compact('photos', 'judgeCollections'));
    }

    public function storeCollection(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'nullable|string|max:7',
        ]);

        $judgeId = Auth::id();

        $collection = JudgeCollection::firstOrCreate([
            'judge_id' => $judgeId,
            'name' => trim($request->name),
        ], [
            'color' => $request->color ?? '#D4AF37',
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'collection' => $collection
            ]);
        }

        return redirect()->back()->with('success', 'Collection "' . $collection->name . '" created successfully.');
    }

    public function togglePhotoCollection(Request $request, Photo $photo)
    {
        $request->validate([
            'collection_id' => 'required|exists:judge_collections,id',
        ]);

        $collection = JudgeCollection::where('id', $request->collection_id)
            ->where('judge_id', Auth::id())
            ->firstOrFail();

        $detached = $collection->photos()->detach($photo->id);
        if (!$detached) {
            $collection->photos()->attach($photo->id);
            $status = 'added';
        } else {
            $status = 'removed';
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'status' => $status
            ]);
        }

        return redirect()->back()->with('success', 'Photo ' . ($status === 'added' ? 'added to' : 'removed from') . ' collection "' . $collection->name . '".');
    }
}
