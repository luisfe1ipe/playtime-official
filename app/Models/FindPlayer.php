<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FindPlayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'active',
        'position_id',
        'character_id',
        'game_id',
    ];

    protected $casts = [
        'active' => 'boolean'
    ];
}
