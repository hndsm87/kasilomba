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

    public function getThumbnailUrlAttribute()
    {
        $base = $this->getBasePreviewUrl();
        return $base ? $base . '=w400' : null;
    }

    public function getMediumUrlAttribute()
    {
        $base = $this->getBasePreviewUrl();
        return $base ? $base . '=w1600' : null;
    }

    public function getOriginalUrlAttribute()
    {
        // For full size, we can use =s0
        $base = $this->getBasePreviewUrl();
        return $base ? $base . '=s0' : null;
    }

    public function getAverageScoreAttribute()
    {
        return $this->scores()->avg('score') ?? 0;
    }
}
