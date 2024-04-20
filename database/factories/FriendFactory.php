<?php

namespace Database\Factories;

use App\Enums\FriendStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Friend>
 */
class FriendFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::pluck('id')->toArray(); // Pegando os IDs como array.
        $user_origin = fake()->randomElement($users); // Selecionando um 'user_origin' aleatório.
        $user_destination = fake()->randomElement(array_diff($users, [$user_origin])); // Selecionando um 'user_destination' garantindo que seja diferente de 'user_origin'.

        return [
            'user_origin' => $user_origin,
            'user_destination' => $user_destination,
            'status' => fake()->randomElement(FriendStatus::cases()), // Selecionar aleatoriamente um status do enum.
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
