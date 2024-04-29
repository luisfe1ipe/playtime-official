<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'is_read',
        'user_id',
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
}
