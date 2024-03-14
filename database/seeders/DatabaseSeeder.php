<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Character;
use App\Models\Game;
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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Luis Felipe',
            'email' => 'luisfelipe@playtime.com',
            'email_verified_at' => now(),
        ]);

        Type::factory(20)->create();
        News::factory(100)->create();

        Game::create([
            'name' => 'Valorant',
            'slug' => 'valorant',
            'photo' => 'https://seeklogo.com/images/V/valorant-logo-FAB2CA0E55-seeklogo.com.png',
            'alternative_photo' => 'https://moewalls.com/wp-content/uploads/2024/03/omen-agent-valorant-thumb.jpg',
            'banner' => 'https://wallpapers.com/images/featured/valorant-305kescxw5dpup7y.jpg',
            'has_characters' => true,
            'active' => true
        ]);

        Position::create([
            'name' => 'Duelista',
            'image' => 'https://static.wikia.nocookie.net/valorant/images/f/fd/DuelistClassSymbol.png/revision/latest?cb=20200408043920',
            'game_id' => 1
        ]);

        Character::create([
            'name' => 'Jett',
            'image' => 'https://static.wikia.nocookie.net/valorant/images/3/35/Jett_icon.png/revision/latest?cb=20220316150455&path-prefix=id',
            'game_id' => 1
        ]);

        Rank::create([
            'name' => 'Ascendente',
            'image' => 'https://static.wikia.nocookie.net/valorant/images/e/e5/Ascendant_1_Rank.png/revision/latest?cb=20220616175506',
            'game_id' => 1
        ]);

        Rank::create([
            'name' => 'Imortal',
            'image' => 'https://cdn3.emoji.gg/emojis/1518-valorant-immortal-1.png',
            'game_id' => 1
        ]);
    }
}
