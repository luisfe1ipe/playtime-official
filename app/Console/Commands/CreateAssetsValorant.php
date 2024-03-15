<?php

namespace App\Console\Commands;

use App\Models\Character;
use App\Models\Game;
use App\Models\Position;
use App\Models\Rank;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CreateAssetsValorant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-assets-valorant';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criar assets para o jogo Valorant';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $valorant = Game::create([
            'name' => 'Valorant',
            'slug' => 'valorant',
            'photo' => Storage::disk('public')->putFile('games/icons/', public_path('images/game/valorant/icon.png')),
            'alternative_photo' => Storage::disk('public')->putFile('games/alternative_photo/', public_path('images/game/valorant/alternative_image.jpg')),
            'banner' => Storage::disk('public')->putFile('games/banner/', public_path('images/game/valorant/banner.jpg')),
            'has_characters' => true,
            'active' => true
        ]);

        $directoryCharacters = public_path('images/game/valorant/characters');
        $imageCharacters = glob($directoryCharacters . '/*');


        foreach ($imageCharacters as $image) {
            $imageName = pathinfo($image, PATHINFO_FILENAME);
            $characterName = str_replace('_icon', '', "$imageName");

            Character::create([
                'name' => $characterName,
                'image' => Storage::disk('public')->putFile('characters/photos/', $image),
                'game_id' => $valorant->id
            ]);
        }

        $directoryPositions = public_path('images/game/valorant/positions');
        $imagePositions = glob($directoryPositions . '/*');

        foreach ($imagePositions as $image) {
            $imageName = pathinfo($image, PATHINFO_FILENAME);
            $positionName = str_replace('ClassSymbol', '', "$imageName");

            switch ($positionName) {
                case $positionName === 'Controller':
                    $positionName = 'Controlador';
                    break;
                case $positionName === 'Duelist':
                    $positionName = 'Duelista';
                    break;
                case $positionName === 'Initiator':
                    $positionName = 'Iniciador';
                    break;
                case $positionName === 'Sentinel':
                    $positionName = 'Sentinela';
                    break;
                default:
                    break;
            }

            Position::create([
                'name' => $positionName,
                'image' => Storage::disk('public')->putFile('positions/photos/', $image),
                'game_id' => $valorant->id
            ]);
        }

        $directoryRanks = public_path('images/game/valorant/ranks');
        $imageRanks = glob($directoryRanks . '/*');

        foreach ($imageRanks as $image) {
            $imageName = pathinfo($image, PATHINFO_FILENAME);
            $rankName = preg_replace('/_(\d+)_Rank/', ' $1', $imageName);

             Rank::create([
                'name' => $rankName,
                'image' => Storage::disk('public')->putFile('positions/photos/', $image),
                'game_id' => $valorant->id
            ]);
        }
    }
}
