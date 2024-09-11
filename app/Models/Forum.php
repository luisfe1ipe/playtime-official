<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Forum extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'blocked',
        'user_id',
        'views',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
