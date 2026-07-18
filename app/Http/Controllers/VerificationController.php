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
        
        $query = Photo::query();

        if ($status === 'Judged') {
            $query->where('verification_status', 'Verified')->has('scores');
        } elseif ($status === 'Verified') {
            $query->where('verification_status', 'Verified')->doesntHave('scores');
        } else {
            $query->where('verification_status', $status);
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

        // Stats for tabs
        $stats = [
            'Waiting Verification' => Photo::where('verification_status', 'Waiting Verification')->count(),
            'Verified' => Photo::where('verification_status', 'Verified')->doesntHave('scores')->count(),
            'Judged' => Photo::where('verification_status', 'Verified')->has('scores')->count(),
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

    public function extractExif(Photo $photo)
    {
        $url = $photo->google_drive_link;
        if (empty($url)) {
            return redirect()->back()->with('error', 'No photo URL available to extract EXIF.');
        }

        $exifData = Photo::extractExifFromUrl($url);

        if (!$exifData) {
            return redirect()->back()->with('error', 'Failed to extract EXIF data. Make sure the file is a valid image and EXIF metadata is present.');
        }

        // Update photo record
        $updateData = [
            'exif_data' => $exifData
        ];

        // If taken_at is default or not set, try to update with EXIF date
        if (!empty($exifData['DateTimeOriginal'])) {
            try {
                $updateData['taken_at'] = \Carbon\Carbon::createFromFormat('Y:m:d H:i:s', $exifData['DateTimeOriginal']);
            } catch (\Exception $e) {
                // ignore
            }
        }

        // If device_used is empty, update with EXIF device
        if (empty($photo->device_used)) {
            $make = $exifData['Make'] ?? '';
            $model = $exifData['Model'] ?? '';
            if (!empty($make) || !empty($model)) {
                $updateData['device_used'] = trim("$make $model");
            }
        }

        // If coordinates are empty, update with EXIF coordinates
        if (empty($photo->coordinates) && isset($exifData['GPSLatitude'], $exifData['GPSLatitudeRef'], $exifData['GPSLongitude'], $exifData['GPSLongitudeRef'])) {
            $lat = Photo::gpsToDecimal($exifData['GPSLatitude'], $exifData['GPSLatitudeRef']);
            $lon = Photo::gpsToDecimal($exifData['GPSLongitude'], $exifData['GPSLongitudeRef']);
            if ($lat !== null && $lon !== null) {
                $updateData['coordinates'] = "$lat, $lon";
            }
        }

        $photo->update($updateData);

        return redirect()->back()->with('success', 'EXIF data extracted successfully.');
    }
}
