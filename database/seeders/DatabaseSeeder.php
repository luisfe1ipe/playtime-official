<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\News;
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
    }
}
