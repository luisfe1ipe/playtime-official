<?php

namespace App\Models;

use App\Enums\FriendStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_origin',
        'user_destination',
        'status',
        'last_message_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => FriendStatus::class,
    ];

    /**
     * Get all of the conversation's messages.
     */
    public function messages(): MorphMany
    {
        return $this->morphMany(Message::class, 'messageable');
    }


    /**
     * Get the user that owns the Friend
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userOrigin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_origin');
    }

    /**
     * Get the user that owns the Friend
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userDestination(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_destination');
    }

    /**
     * Get the lastMessage that owns the Friend
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lastMessage(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'last_message_id');
    }
}
