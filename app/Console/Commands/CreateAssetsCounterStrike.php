<?php

namespace App\Console\Commands;

use App\Models\Game;
use App\Models\Position;
use App\Models\Rank;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CreateAssetsCounterStrike extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-assets-counter-strike';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cs = Game::create([
            'name' => 'Counter-Strike 2',
            'slug' => 'counter-strike-2',
            'photo' => Storage::disk('public')->putFile('games/icons/', public_path('images/game/counter-strike/icon.png')),
            'alternative_photo' => Storage::disk('public')->putFile('games/alternative_photo/', public_path('images/game/counter-strike/alternative_image.jpeg')),
            'banner' => Storage::disk('public')->putFile('games/banner/', public_path('images/game/counter-strike/banner.jpg')),
            'has_characters' => false,
            'active' => true
        ]);

        $directoryPositions = public_path('images/game/counter-strike/positions');
        $imagePositions = glob($directoryPositions . '/*');


        foreach ($imagePositions as $image) {
            $imageName = pathinfo($image, PATHINFO_FILENAME);



            switch ($imageName) {
                case $imageName === 'beginner':
                    $imageName = 'Iniciante';
                    break;
                case $imageName === 'coach':
                    $imageName = 'Coach';
                    break;
                case $imageName === 'entry':
                    $imageName = 'Entry Fragger';
                    break;
                case $imageName === 'igl':
                    $imageName = 'Capitão (IGL)';
                    break;
                case $imageName === 'lurker':
                    $imageName = 'Lurker';
                    break;
                case $imageName === 'rifler':
                    $imageName = 'Rifler';
                    break;
                case $imageName === 'sniper':
                    $imageName = 'Sniper';
                    break;
                case $imageName === 'support':
                    $imageName = 'Suporte';
                    break;
                default:
                    break;
            }

            Position::create([
                'name' => $imageName,
                'image' => Storage::disk('public')->putFile('positions/photos/', $image),
                'game_id' => $cs->id
            ]);
        }

        $directoryRanks = public_path('images/game/counter-strike/ranks');
        $imageRanks = glob($directoryRanks . '/*');

        foreach ($imageRanks as $image) {
            $imageName = pathinfo($image, PATHINFO_FILENAME);
            $nameWithoutCode = preg_replace('/_[a-f0-9]+$/', '', $imageName);
            $rankName = str_replace('_', ' ', $nameWithoutCode);

            switch ($rankName) {
                case str_contains($rankName, 'silver'):
                    switch ($rankName) {
                        case $rankName == 'silver 1':
                            $rankName = 'Prata 1';
                            break;
                        case $rankName == 'silver 2':
                            $rankName = 'Prata 2';
                            break;
                        case $rankName == 'silver 3':
                            $rankName = 'Prata 3';
                            break;
                        case $rankName == 'silver 4':
                            $rankName = 'Prata 4';
                            break;
                        case $rankName == 'silver elite':
                            $rankName = 'Prata Elite';
                            break;
                        case $rankName == 'silver elite master':
                            $rankName = 'Prata Elite Mestre';
                            break;
                    }
                    break;
                case str_contains($rankName, 'gold'):
                    switch ($rankName) {
                        case $rankName == 'gold nova 1':
                            $rankName = 'Ouro 1';
                            break;
                        case $rankName == 'gold nova 2':
                            $rankName = 'Ouro 2';
                            break;
                        case $rankName == 'gold nova 3':
                            $rankName = 'Ouro 3';
                            break;
                        case $rankName == 'gold nova master':
                            $rankName = 'Ouro 4';
                            break;
                    }
                    break;
                case $rankName == 'master guardian 1':
                    $rankName = 'AK 1';
                    break;
                case $rankName == 'master guardian 2':
                    $rankName = 'AK 2';
                    break;
                case $rankName == 'master guardian elite':
                    $rankName = 'AK Cruzada';
                    break;
                case $rankName == 'distinguished master guardian':
                    $rankName = 'Xerife';
                    break;
                case $rankName == 'legendary eagle':
                    $rankName = 'Águia 1';
                    break;
                case $rankName == 'legendary eagle master':
                    $rankName = 'Águia 2';
                    break;
                case $rankName == 'supreme master first class':
                    $rankName = 'Supremo';
                    break;
                case $rankName == 'global elite':
                    $rankName = 'Global';
                    break;
                default:
                    break;
            }

            Rank::create([
                'name' => $rankName,
                'image' => Storage::disk('public')->putFile('ranks/photos/', $image),
                'game_id' => $cs->id
            ]);
        }
    }
}
