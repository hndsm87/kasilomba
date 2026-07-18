<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JudgeCollection extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function judge()
    {
        return $this->belongsTo(User::class, 'judge_id');
    }

    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'judge_collection_photo');
    }
}
