<?php

use App\Models\Game;
use App\Models\Rank;
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
        Schema::create('game_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Game::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Rank::class)->nullable();
            $table->string('description')->nullable();
            $table->json('days_times_play');
            $table->json('positions')->nullable();
            $table->json('characters')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_user');
    }
};
