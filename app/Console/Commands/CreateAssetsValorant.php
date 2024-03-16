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

            switch ($rankName) {
                case str_contains($rankName, 'Silver'):
                    switch ($rankName) {
                        case $rankName == 'Silver 1':
                            $rankName = 'Prata 1';
                            break;
                        case $rankName == 'Silver 2':
                            $rankName = 'Prata 2';
                            break;
                        case $rankName == 'Silver 3':
                            $rankName = 'Prata 3';
                            break;
                    }
                    break;
                case str_contains($rankName, 'Gold'):
                    switch ($rankName) {
                        case $rankName == 'Gold 1':
                            $rankName = 'Ouro 1';
                            break;
                        case $rankName == 'Gold 2':
                            $rankName = 'Ouro 2';
                            break;
                        case $rankName == 'Gold 3':
                            $rankName = 'Ouro 3';
                            break;
                    }
                    break;
                case str_contains($rankName, 'Immortal'):
                    switch ($rankName) {
                        case $rankName == 'Immortal 1':
                            $rankName = 'Imortal 1';
                            break;
                        case $rankName == 'Immortal 2':
                            $rankName = 'Imortal 2';
                            break;
                        case $rankName == 'Immortal 3':
                            $rankName = 'Imortal 3';
                            break;
                    }
                    break;
                case str_contains($rankName, 'Iron'):
                    switch ($rankName) {
                        case $rankName == 'Iron 1':
                            $rankName = 'Ferro 1';
                            break;
                        case $rankName == 'Iron 2':
                            $rankName = 'Ferro 2';
                            break;
                        case $rankName == 'Iron 3':
                            $rankName = 'Ferro 3';
                            break;
                    }
                    break;
                case str_contains($rankName, 'Platinum'):
                    switch ($rankName) {
                        case $rankName == 'Platinum 1':
                            $rankName = 'Platina 1';
                            break;
                        case $rankName == 'Platinum 2':
                            $rankName = 'Platina 2';
                            break;
                        case $rankName == 'Platinum 3':
                            $rankName = 'Platina 3';
                            break;
                    }
                    break;
                case str_contains($rankName, 'Diamond'):
                    switch ($rankName) {
                        case $rankName == 'Diamond 1':
                            $rankName = 'Diamante 1';
                            break;
                        case $rankName == 'Diamond 2':
                            $rankName = 'Diamante 2';
                            break;
                        case $rankName == 'Diamond 3':
                            $rankName = 'Diamante 3';
                            break;
                    }
                    break;
                case str_contains($rankName, 'Ascendant'):
                    switch ($rankName) {
                        case $rankName == 'Ascendant 1':
                            $rankName = 'Ascendente 1';
                            break;
                        case $rankName == 'Ascendant 2':
                            $rankName = 'Ascendente 2';
                            break;
                        case $rankName == 'Ascendant 3':
                            $rankName = 'Ascendente 3';
                            break;
                    }
                    break;
                case str_contains($rankName, 'Bronze'):
                    switch ($rankName) {
                        case $rankName == 'Bronze 1':
                            $rankName = 'Bronze 1';
                            break;
                        case $rankName == 'Bronze 2':
                            $rankName = 'Bronze 2';
                            break;
                        case $rankName == 'Bronze 3':
                            $rankName = 'Bronze 3';
                            break;
                    }
                    break;
                default:
                    $rankName = 'Radiante';
                    break;
            }

            Rank::create([
                'name' => $rankName,
                'image' => Storage::disk('public')->putFile('ranks/photos/', $image),
                'game_id' => $valorant->id
            ]);
        }
    }
}
