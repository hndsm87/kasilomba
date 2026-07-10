<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'Waiting Verification');
        
        $query = Photo::where('verification_status', $status);
        
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('participant_name', 'like', "%{$search}%")
                  ->orWhere('village', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%");
            });
        }

        $photos = $query->orderBy('created_at', 'desc')->paginate(20);

        // Stats for tabs
        $stats = [
            'Waiting Verification' => Photo::where('verification_status', 'Waiting Verification')->count(),
            'Verified' => Photo::where('verification_status', 'Verified')->count(),
            'Ready for Judging' => Photo::where('verification_status', 'Ready for Judging')->count(),
            'Judging' => Photo::where('verification_status', 'Judging')->count(),
            'Finished' => Photo::where('verification_status', 'Finished')->count(),
            'Disqualified' => Photo::where('verification_status', 'Disqualified')->count(),
        ];

        return view('admin.verification.index', compact('photos', 'status', 'stats'));
    }

    public function show(Photo $photo)
    {
        return view('admin.verification.workspace', compact('photo'));
    }

    public function approve(Photo $photo)
    {
        $photo->update([
            'verification_status' => 'Verified',
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        activity()
            ->performedOn($photo)
            ->causedBy(Auth::user())
            ->log('approved_verification');

        return $this->nextPending($photo->id, 'Submission verified successfully.');
    }

    public function reject(Request $request, Photo $photo)
    {
        $request->validate([
            'reason' => 'required|string',
            'notes' => 'required|string',
        ]);

        $photo->update([
            'verification_status' => 'Disqualified',
            'verification_notes' => "Reason: {$request->reason}\nNotes: {$request->notes}",
            'is_disqualified' => true,
            'status' => 'disqualified',
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        activity()
            ->performedOn($photo)
            ->causedBy(Auth::user())
            ->withProperties(['reason' => $request->reason, 'notes' => $request->notes])
            ->log('rejected_verification');

        return $this->nextPending($photo->id, 'Submission rejected and disqualified.');
    }

    private function nextPending($currentId, $message)
    {
        $nextPhoto = Photo::where('verification_status', 'Waiting Verification')
            ->where('id', '>', $currentId)
            ->first();

        if (!$nextPhoto) {
            // Loop back to beginning
            $nextPhoto = Photo::where('verification_status', 'Waiting Verification')->first();
        }

        if ($nextPhoto) {
            return redirect()->route('admin.submissions.show', $nextPhoto->id)->with('success', $message);
        }

        return redirect()->route('admin.submissions.index')->with('success', $message . ' Queue is now empty.');
    }
}
