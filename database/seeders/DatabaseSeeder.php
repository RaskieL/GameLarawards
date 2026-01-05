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
            [
                'title' => 'Sea of Stars',
                'description' => 'Beautiful retro-inspired RPG with modern gameplay',
                'cover_image' => 'games/sea_of_stars.jpg',
                'developer' => 'Sabotage Studio',
            ],
            [
                'title' => 'Cocoon',
                'description' => 'Puzzle adventure from the lead gameplay designer of Limbo and Inside',
                'cover_image' => 'games/cocoon.jpg',
                'developer' => 'Geometric Interactive',
            ],
            [
                'title' => 'Dredge',
                'description' => 'Lovecraftian fishing adventure with haunting atmosphere',
                'cover_image' => 'games/dredge.jpg',
                'developer' => 'Black Salt Games',
            ],

            // Narrative Games
            [
                'title' => 'Alan Wake 2',
                'description' => 'Survival horror with mind-bending narrative',
                'cover_image' => 'games/alan_wake_2.jpg',
                'developer' => 'Remedy Entertainment',
            ],
            [
                'title' => 'Marvel\'s Spider-Man 2',
                'description' => 'Dual-hero story with emotional depth',
                'cover_image' => 'games/spiderman_2.jpg',
                'developer' => 'Insomniac Games',
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
            [
                'title' => 'Viewfinder',
                'description' => 'Mind-bending puzzle game about perspective',
                'cover_image' => 'games/viewfinder.jpg',
                'developer' => 'Sad Owl Studios',
            ],

            // Multiplayer Games
            [
                'title' => 'Street Fighter 6',
                'description' => 'Fighting game with incredible depth and accessibility',
                'cover_image' => 'games/street_fighter_6.jpg',
                'developer' => 'Capcom',
            ],
            [
                'title' => 'Lethal Company',
                'description' => 'Co-op horror comedy about collecting scrap',
                'cover_image' => 'games/lethal_company.jpg',
                'developer' => 'Zeekerss',
            ],
        ]);

        $categories = Category::all();
        $games = Game::all();

        $games[0]->categories()->attach([1, 4, 7, 9]); // Elden Ring: GOTY, Art, RPG, Innovation
        $games[1]->categories()->attach([1, 3, 8]); // God of War: GOTY, Narrative, Action
        $games[2]->categories()->attach([1, 4, 9]); // Zelda: GOTY, Art, Innovation
        $games[3]->categories()->attach([1, 3, 7]); // Baldur's Gate: GOTY, Narrative, RPG
        $games[4]->categories()->attach([1, 3, 9]); // Cyberpunk: GOTY, Narrative, Innovation

        $games[5]->categories()->attach([2, 4]); // Hollow Knight: Indie, Art
        $games[6]->categories()->attach([2, 7]); // Hades II: Indie, RPG
        $games[7]->categories()->attach([2, 5]); // Sea of Stars: Indie, Soundtrack
        $games[8]->categories()->attach([2, 4, 9]); // Cocoon: Indie, Art, Innovation
        $games[9]->categories()->attach([2, 3]); // Dredge: Indie, Narrative

        $games[10]->categories()->attach([3, 5]); // Alan Wake 2: Narrative, Soundtrack
        $games[11]->categories()->attach([3, 8]); // Spider-Man 2: Narrative, Action
        $games[12]->categories()->attach([3, 5, 7]); // FF XVI: Narrative, Soundtrack, RPG

        $games[13]->categories()->attach([4, 5, 9]); // Hi-Fi Rush: Art, Soundtrack, Innovation
        $games[14]->categories()->attach([4, 9]); // Viewfinder: Art, Innovation

        $games[15]->categories()->attach([6, 10]); // Street Fighter 6: Multiplayer, Players' Choice
        $games[16]->categories()->attach([6, 10]); // Lethal Company: Multiplayer, Players' Choice
    }
}
