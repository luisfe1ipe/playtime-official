<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Conversation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id_1',
        'user_id_2',
    ];

    /**
     * Get all of the conversation's comments.
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Message::class, 'messageable');
    }
}
