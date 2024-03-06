<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'photo',
        'color',
        'alternative_photo',
        'banner',
        'has_characters',
        'active',
    ];

    protected $casts = [
        'has_characters' => 'boolean',
        'active' => 'boolean',
    ];
}
