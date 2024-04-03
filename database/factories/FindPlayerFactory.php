<?php

namespace Database\Factories;

use App\Models\Character;
use App\Models\FindPlayer;
use App\Models\Game;
use App\Models\Position;
use App\Models\Rank;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FindPlayer>
 */
class FindPlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $game = Game::inRandomOrder()->first();

        if($game->has_characters)
        {
            return [
                'title' => $this->faker->text(),
                'description' => $this->faker->text(800),
                'active' => true,
                'game_id' => $game->id,
                'position_id' => $game->positions()->inRandomOrder()->first()->id,
                'character_id' => $game->characters()->inRandomOrder()->first()->id,
                'rank_min_id' => $game->ranks()->inRandomOrder()->first()->id,
                'rank_max_id' => $game->ranks()->inRandomOrder()->first()->id,
                'user_id' => 2,
                'created_at' => $this->faker->dateTime()
            ];
        }

        return [
            'title' => $this->faker->text(),
            'description' => $this->faker->text(800),
            'active' => true,
            'game_id' => $game->id,
            'position_id' => $game->positions()->inRandomOrder()->first()->id,
            'rank_min_id' => $game->ranks()->inRandomOrder()->first()->id,
            'rank_max_id' => $game->ranks()->inRandomOrder()->first()->id,
            'user_id' => 2,
            'created_at' => $this->faker->dateTime()
        ];
    }
}
