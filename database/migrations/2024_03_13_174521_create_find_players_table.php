<?php

use App\Models\Character;
use App\Models\Game;
use App\Models\Position;
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
        Schema::create('find_players', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->boolean('active');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Position::class)->nullable();
            $table->foreignIdFor(Character::class)->nullable();
            $table->foreignIdFor(Game::class);
            $table->foreignId('rank_min_id')->nullable()->constrained('ranks');
            $table->foreignId('rank_max_id')->nullable()->constrained('ranks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('find_players');
    }
};
