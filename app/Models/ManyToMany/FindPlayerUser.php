<?php

namespace App\Models\ManyToMany;

use App\Enums\FindPlayerStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FindPlayerUser extends Model
{
    use HasFactory;

    protected $table = 'find_player_user';

    protected $fillable = [
        'user_id',
        'find_player_id',
        'status',
    ];

    protected $casts = [
        'status' => FindPlayerStatus::class
    ];
}
