<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'is_read',
        'sender_id',
        'receiver_id',
        'replied_message_id',
        'messageable_id',
        'messageable_type',
    ];

    /**
     * Get the parent messageable model (conversation or group).
     */
    public function messageable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the sender that owns the Message
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the receiver that owns the Message
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Get all of the attachments for the Message
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(MessageAttachment::class);
    }
}
