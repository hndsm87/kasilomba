<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'taken_at' => 'date',
        'is_disqualified' => 'boolean',
        'exif_data' => 'array',
    ];

    /**
     * Relationships
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function judgeCollections()
    {
        return $this->belongsToMany(JudgeCollection::class, 'judge_collection_photo');
    }

    /**
     * Accessors for Google Drive image sizes
     */
    
    // Gets the base URL without sizing parameters
    private function getBasePreviewUrl()
    {
        $url = $this->google_drive_preview;
        if (!$url) return null;
        
        // If it already has sizing parameters like =w..., remove them
        if (strpos($url, '=') !== false) {
            $parts = explode('=', $url);
            return $parts[0];
        }
        
        return $url;
    }

    private function isGoogleUrl($url)
    {
        return strpos($url, 'googleusercontent.com') !== false;
    }

    public function getThumbnailUrlAttribute()
    {
        $base = $this->getBasePreviewUrl();
        if (!$base) return null;
        
        if ($this->isGoogleUrl($base)) {
            return $base . '=w400';
        }
        
        return 'https://images.weserv.nl/?url=' . urlencode($base) . '&w=400&fit=cover';
    }

    public function getMediumUrlAttribute()
    {
        $base = $this->getBasePreviewUrl();
        if (!$base) return null;
        
        if ($this->isGoogleUrl($base)) {
            return $base . '=w1600';
        }

        return 'https://images.weserv.nl/?url=' . urlencode($base) . '&w=1600';
    }

    public function getOriginalUrlAttribute()
    {
        $base = $this->getBasePreviewUrl();
        if (!$base) return null;
        return $this->isGoogleUrl($base) ? $base . '=s0' : $base;
    }

    public function getAverageScoreAttribute()
    {
        return $this->scores()->avg('score') ?? 0;
    }

    /**
     * Duplicate Detection
     */
    public function duplicatePhotos()
    {
        return Photo::where('id', '!=', $this->id)
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->whereNotNull('whatsapp')
                      ->where('whatsapp', '!=', '')
                      ->where('whatsapp', $this->whatsapp);
                })->orWhere(function ($q) {
                    $q->whereNotNull('instagram')
                      ->where('instagram', '!=', '')
                      ->where('instagram', $this->instagram);
                });
            });
    }

    public function getIsDuplicateAttribute()
    {
        if (empty($this->whatsapp) && empty($this->instagram)) {
            return false;
        }
        
        return $this->duplicatePhotos()->exists();
    }

    /**
     * Extract EXIF metadata from a given URL (supporting Google Drive and S3).
     */
    public static function extractExifFromUrl($url)
    {
        if (empty($url)) {
            return null;
        }

        try {
            // Resolve direct download URL for Google Drive
            $downloadUrl = $url;
            if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
                $fileId = $matches[1];
                $downloadUrl = "https://docs.google.com/uc?export=download&id=" . $fileId;
            }

            // Fetch the first 128KB (to parse EXIF without downloading the whole file)
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $downloadUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_RANGE, '0-131072'); // 128 KB
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');

            $data = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            // If range request is not supported or returns error, fallback to downloading full file
            if ($httpCode !== 200 && $httpCode !== 206) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $downloadUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 15);
                curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');

                $data = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                if ($httpCode !== 200 || empty($data)) {
                    \Illuminate\Support\Facades\Log::warning("Failed to download image for EXIF. HTTP Code: " . $httpCode);
                    return null;
                }
            }

            // Write temporary file
            $tempFile = tempnam(sys_get_temp_dir(), 'exif_');
            file_put_contents($tempFile, $data);

            // Extract EXIF data
            $exif = @exif_read_data($tempFile);
            unlink($tempFile);

            if ($exif === false || !is_array($exif)) {
                return null;
            }

            // Clean binary or very long raw tags to keep the JSON clean
            $cleanExif = [];
            foreach ($exif as $key => $value) {
                if (in_array(strtolower($key), ['makernote', 'maker_note', 'thumbnail', 'usercomment', 'user_comment'])) {
                    continue;
                }
                
                if (is_string($value)) {
                    $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8,ISO-8859-1,ASCII');
                }
                
                $cleanExif[$key] = $value;
            }

            return $cleanExif;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('EXIF extraction exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Convert rational GPS EXIF notation to float decimal degrees.
     */
    public static function gpsToDecimal($gps, $ref)
    {
        if (!is_array($gps) || count($gps) < 3) {
            return null;
        }

        $degrees = self::rationalToFloat($gps[0]);
        $minutes = self::rationalToFloat($gps[1]);
        $seconds = self::rationalToFloat($gps[2]);

        $decimal = $degrees + ($minutes / 60) + ($seconds / 3600);

        if ($ref === 'S' || $ref === 'W') {
            $decimal = -$decimal;
        }

        return $decimal;
    }

    private static function rationalToFloat($rational)
    {
        if (is_numeric($rational)) {
            return floatval($rational);
        }
        
        $parts = explode('/', $rational);
        if (count($parts) === 2 && $parts[1] != 0) {
            return floatval($parts[0]) / floatval($parts[1]);
        }
        
        return 0;
    }
}
