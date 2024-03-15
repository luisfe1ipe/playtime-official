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
            $rankName = preg_replace('/_(\d+)_Rank/', ' $1', $imageName);

            Rank::create([
                'name' => $rankName,
                'image' => Storage::disk('public')->putFile('ranks/photos/', $image),
                'game_id' => $cs->id
            ]);
        }
    }
}
