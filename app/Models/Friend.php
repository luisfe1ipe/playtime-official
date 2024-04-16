<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_origin',
        'user_destination',
        'status'
    ];

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
}
