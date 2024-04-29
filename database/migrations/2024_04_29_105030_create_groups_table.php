<?php

use App\Models\Group;
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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->longText('image');
            $table->foreignIdFor(Message::class, 'last_message_id')->nullable();
            $table->foreignIdFor(User::class, 'ownder_id');
            $table->timestamps();
        });

        Schema::create('group_users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Group::class);
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
        Schema::dropIfExists('group_user');
    }
};
