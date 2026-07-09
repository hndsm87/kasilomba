<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;
    
    // Explicitly define the table name since it should be 'criterias'
    protected $table = 'criterias';

    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
