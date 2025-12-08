<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Category::factory()->create([
            [
                'name' => 'Game of the year',
                'description' => 'Users most beloved game of the year',
            ],
            [
                'name' => 'Not the game of the year',
                'description' => 'Users absolutely not favourite game of the year',
            ]
        ]);

        // Game::factory()->create([
        //     []
        // ]);
    }
}
