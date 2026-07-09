<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Score extends Model
{
    use HasFactory, LogsActivity;

    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['score', 'notes'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function judge()
    {
        return $this->belongsTo(User::class, 'judge_id');
    }

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}
