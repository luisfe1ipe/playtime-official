<?php

namespace Database\Factories;

use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $photos = [
            'https://static.gamevicio.com/imagens_up/big/92/marvel-s-spider-man-2-ganha-data-oficial-de-lancamento-confira-091376.jpg',
            'https://static.gamevicio.com/imagens_up/big/95/starfield-linha-do-tempo-detalhada-e-disponibilizada-pela-bethesda-094767.png',
            'https://static.gamevicio.com/imagens_up/big/85/vaza-gameplay-de-horizon-multiplayer-084839.png',
            'https://static.gamevicio.com/imagens_up/big/94/armored-core-vi-fires-of-rubicon-ganha-novo-gameplay-093710.jpg',
            'https://static.gamevicio.com/imagens_up/big/95/fifa-23-foi-o-jogo-mais-vendido-do-reino-unido-em-julho-ps5-continua-liderando-094743.jpg',
            'https://static.gamevicio.com/imagens_up/big/95/forza-motorsport-nao-oferece-suporte-para-multiplayer-em-tela-dividida-no-lancamento-094737.jpg',
            'https://static.gamevicio.com/imagens_up/big/95/lords-of-the-fallen-nao-seria-possivel-sem-o-poder-do-ps5-e-xbox-series-094590.jpg'

        ];

        shuffle($photos);

        $user = User::count();
        $typeNews = Type::count();

        $createdAt = fake()->dateTimeBetween('-4 weeks', 'now');

        return [
            'title' => fake()->sentence(),
            'subtitle' => fake()->paragraph(1),
            'text' => fake()->text(1000),
            'image' => array_shift($photos),
            'views' => fake()->numberBetween(99, 9999),
            'user_id' => fake()->numberBetween(1, $user),
            'type_id' => fake()->numberBetween(1, $typeNews),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
