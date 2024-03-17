<?php

namespace Database\Factories\ManyToMany;

use App\Models\FindPlayer;
use App\Models\ManyToMany\FindPlayerUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FindPlayerUserFactory extends Factory
{

    protected $model = FindPlayerUser::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::count();
        $findPlayers = FindPlayer::count();

        return [
            'user_id' => fake()->numberBetween(1, $users),
            'find_player_id' => fake()->numberBetween(1, $findPlayers)
        ];
    }
}
