<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id_1',
        'user_id_2',
        'last_message_id'
    ];

    /**
     * Get all of the conversation's messages.
     */
    public function messages(): MorphMany
    {
        return $this->morphMany(Message::class, 'messageable');
    }

    /**
     * Get the user_id_1 that owns the Conversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_id_1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_1');
    }

    /**
     * Get the user_id_2 that owns the Conversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_id_2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id_2');
    }
}
