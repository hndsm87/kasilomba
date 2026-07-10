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
}
