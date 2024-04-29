<?php

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('message')->nullable();
            $table->boolean('is_read');
            $table->foreignIdFor(User::class, 'sender_id');
            $table->foreignIdFor(User::class, 'receiver_id')->nullable();
            $table->foreignIdFor(Message::class, 'replied_message_id')->nullable();
            $table->morphs('messageable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
