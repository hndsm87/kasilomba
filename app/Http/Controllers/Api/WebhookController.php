<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\SyncLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    /**
     * Handle incoming webhook from Fillout.
     */
    public function handleFillout(Request $request)
    {
        try {
            $payload = $request->all();

            // Log the incoming payload for debugging purposes
            Log::info('Fillout Webhook Received', ['payload' => $payload]);

            // Handle Fillout's "Test" ping which might have null submissionId
            if (empty($payload)) {
                return response()->json(['message' => 'Empty payload received.'], 200);
            }

            // Check if the expected Fillout structure is present
            if (!isset($payload['submission']) || !isset($payload['submission']['questions'])) {
                // Return 200 for unrecognized format to avoid Fillout test errors, but don't process
                return response()->json([
                    'message' => 'Invalid payload format or test ping.',
                    'payload_received' => $payload
                ], 200);
            }

            $submissionId = $payload['submission']['submissionId'] ?? 'test-submission-' . time();
            $fields = collect($payload['submission']['questions']);

            // Helper function to find a field value by its name (case-insensitive partial match)
            $getFieldValue = function ($name, $default = null) use ($fields) {
                $field = $fields->first(function ($item) use ($name) {
                    return stripos($item['name'], $name) !== false;
                });
                
                if (!$field) {
                    return $default;
                }

                $value = $field['value'] ?? $default;

                // If the value is a string that looks like a URL, just return it
                if (is_string($value)) {
                    return $value;
                }

                // If the value is an array (like file uploads in Fillout), extract the URL
                if (is_array($value) && !empty($value)) {
                    if (isset($value[0]['url'])) {
                        return $value[0]['url']; // Common for file uploads
                    }
                    // If it's just an array of strings
                    if (is_string($value[0])) {
                        return $value[0];
                    }
                }

                return $value;
            };

            // Extract data
            $title = $getFieldValue('Judul Foto', 'Untitled Photo');
            $story = $getFieldValue('Cerita atau Deskripsi', 'No story provided.');
            $categoryRaw = strtolower($getFieldValue('Pilih Kategori Lomba', 'smartphone'));
            $category = str_contains($categoryRaw, 'dslr') ? 'dslr' : 'smartphone';
            
            $location = $getFieldValue('Lokasi Pengambilan', 'Unknown');
            $driveLink = $getFieldValue('Upload Foto', null);
            
            // Map the drive link to preview/thumbnail fields
            $drivePreview = $driveLink;
            $driveThumbnail = $driveLink;

            // If it's a standard Google Drive view link, we can attempt to extract the ID
            // Format: https://drive.google.com/file/d/1a2b3c4d5e/view
            if ($driveLink && preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $driveLink, $matches)) {
                $fileId = $matches[1];
                $drivePreview = "https://lh3.googleusercontent.com/d/{$fileId}";
                $driveThumbnail = "https://lh3.googleusercontent.com/d/{$fileId}";
            }

            // Create or update the photo record
            $photo = Photo::updateOrCreate(
                ['sync_id' => $submissionId],
                [
                    'title' => $title,
                    'story' => $story,
                    'category' => $category,
                    'location' => $location,
                    'google_drive_link' => $driveLink,
                    'google_drive_preview' => $drivePreview,
                    'google_drive_thumbnail' => $driveThumbnail,
                    'taken_at' => now(), // Default to now if not provided
                    'status' => 'pending'
                ]
            );

            // Log successful sync
            SyncLog::create([
                'row_count' => 1,
                // created_by is typically a user ID, but webhooks have no auth user. 
                // In a real scenario, we might make this nullable or assign a system user ID.
                // Assuming Admin user is ID 1 for automated webhook logs:
                'created_by' => 1, 
                'status' => 'success',
            ]);

            return response()->json([
                'message' => 'Successfully processed webhook.',
                'photo_id' => $photo->id
            ], 200);

        } catch (\Exception $e) {
            Log::error('Fillout Webhook Error', ['error' => $e->getMessage()]);
            
            SyncLog::create([
                'row_count' => 0,
                'created_by' => 1,
                'status' => 'failed',
                'error_message' => $e->getMessage()
            ]);

            return response()->json(['message' => 'Internal server error processing webhook.'], 500);
        }
    }
}
