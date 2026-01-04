<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Game;
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
            'role' => 'user',
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        Category::factory()->createMany([
            [
                'name' => 'Game of the Year',
                'description' => 'The most outstanding game of the year',
            ],
            [
                'name' => 'Best Indie Game',
                'description' => 'Best independently developed game',
            ],
            [
                'name' => 'Best Narrative',
                'description' => 'Game with the most compelling story',
            ],
            [
                'name' => 'Best Art Direction',
                'description' => 'Most visually stunning game',
            ],
            [
                'name' => 'Best Soundtrack',
                'description' => 'Game with the best musical score',
            ],
            [
                'name' => 'Best Multiplayer',
                'description' => 'Best game for playing with friends',
            ],
            [
                'name' => 'Best RPG',
                'description' => 'Best role-playing game',
            ],
            [
                'name' => 'Best Action Game',
                'description' => 'Best fast-paced action experience',
            ],
            [
                'name' => 'Best Innovation',
                'description' => 'Game that pushes boundaries the most',
            ],
            [
                'name' => "Players' Choice",
                'description' => 'Game voted by the community',
            ],
        ]);

        Game::factory()->createMany([
            // AAA Games
            [
                'title' => 'Elden Ring',
                'description' => 'A masterpiece of open-world design and challenging combat',
                'cover_image' => 'games/elden_ring.jpg',
                'developer' => 'FromSoftware',
            ],
            [
                'title' => 'God of War: Ragnarok',
                'description' => 'Epic conclusion to Kratos and Atreus Norse saga',
                'cover_image' => 'games/gow_ragnarok.jpg',
                'developer' => 'Santa Monica Studio',
            ],
            [
                'title' => 'The Legend of Zelda: Tears of the Kingdom',
                'description' => 'Innovative sequel that expands the Breath of the Wild formula',
                'cover_image' => 'games/zelda_totk.jpg',
                'developer' => 'Nintendo',
            ],
            [
                'title' => 'Baldur\'s Gate 3',
                'description' => 'Deep, narrative-driven RPG with unparalleled player choice',
                'cover_image' => 'games/baldurs_gate_3.jpg',
                'developer' => 'Larian Studios',
            ],
            [
                'title' => 'Cyberpunk 2077: Phantom Liberty',
                'description' => 'Redeemed with incredible expansion and updates',
                'cover_image' => 'games/cyberpunk.jpg',
                'developer' => 'CD Projekt Red',
            ],

            // Indie Games
            [
                'title' => 'Hollow Knight: Silksong',
                'description' => 'Highly anticipated sequel to the indie masterpiece',
                'cover_image' => 'games/hollow_knight.jpg',
                'developer' => 'Team Cherry',
            ],
            [
                'title' => 'Hades II',
                'description' => 'Supergiant Games returns with another roguelike masterpiece',
                'cover_image' => 'games/hades_2.jpg',
                'developer' => 'Supergiant Games',
            ],

            // Narrative Games
            [
                'title' => 'Alan Wake 2',
                'description' => 'Survival horror with mind-bending narrative',
                'cover_image' => 'games/alan_wake_2.jpg',
                'developer' => 'Remedy Entertainment',
            ],
            [
                'title' => 'Final Fantasy XVI',
                'description' => 'Dark fantasy epic with mature storytelling',
                'cover_image' => 'games/ff16.jpg',
                'developer' => 'Square Enix',
            ],

            // Visual Masterpieces
            [
                'title' => 'Hi-Fi Rush',
                'description' => 'Rhythm-action game with stunning cel-shaded visuals',
                'cover_image' => 'games/hifi_rush.jpg',
                'developer' => 'Tango Gameworks',
            ],

            // Multiplayer Games
            [
                'title' => 'Lethal Company',
                'description' => 'Co-op horror comedy about collecting scrap',
                'cover_image' => 'games/lethal_company.jpg',
                'developer' => 'Zeekerss',
            ],
        ]);
    }
}
