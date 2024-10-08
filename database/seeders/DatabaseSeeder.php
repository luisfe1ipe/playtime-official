<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Character;
use App\Models\FindPlayer;
use App\Models\Friend;
use App\Models\Game;
use App\Models\ManyToMany\FindPlayerUser;
use App\Models\News;
use App\Models\Position;
use App\Models\Rank;
use App\Models\Team;
use App\Models\Type;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Luis Felipe',
            'email' => 'luisfelipe@playtime.com',
            'email_verified_at' => now(),
        ]);

        Type::factory(20)->create();
        News::factory(100)->create();
        \App\Models\User::factory(200)->create();
        FindPlayer::factory(200)->create();
        FindPlayerUser::factory(count: 800)->create();
        Friend::factory(count: 10000)->create();
        Team::factory(200)->create();
    }
}
