<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function judge()
    {
        return $this->belongsTo(User::class, 'judge_id');
    }
}
