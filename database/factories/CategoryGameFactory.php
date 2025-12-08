<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryGame>
 */
class CategoryGameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'game_id' => \App\Models\Game::query()->inRandomOrder()->value('id'),
            'category_id' => \App\Models\Category::query()->inRandomOrder()->value('id'),
        ];
    }
}
