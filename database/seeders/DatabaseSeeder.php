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

        // Link Games to Categories
        $goty = Category::where('name', 'Game of the Year')->first();
        $indie = Category::where('name', 'Best Indie Game')->first();
        $narrative = Category::where('name', 'Best Narrative')->first();
        $art = Category::where('name', 'Best Art Direction')->first();
        $soundtrack = Category::where('name', 'Best Soundtrack')->first();
        $multiplayer = Category::where('name', 'Best Multiplayer')->first();
        $rpg = Category::where('name', 'Best RPG')->first();
        $action = Category::where('name', 'Best Action Game')->first();
        $innovation = Category::where('name', 'Best Innovation')->first();
        $playersChoice = Category::where('name', "Players' Choice")->first();

        $eldenRing = Game::where('title', 'Elden Ring')->first();
        $gow = Game::where('title', 'God of War: Ragnarok')->first();
        $zelda = Game::where('title', 'The Legend of Zelda: Tears of the Kingdom')->first();
        $bg3 = Game::where('title', "Baldur's Gate 3")->first();
        $cyberpunk = Game::where('title', 'Cyberpunk 2077: Phantom Liberty')->first();
        $hollowKnight = Game::where('title', 'Hollow Knight: Silksong')->first();
        $hades2 = Game::where('title', 'Hades II')->first();
        $alanWake2 = Game::where('title', 'Alan Wake 2')->first();
        $ff16 = Game::where('title', 'Final Fantasy XVI')->first();
        $hifiRush = Game::where('title', 'Hi-Fi Rush')->first();
        $lethalCompany = Game::where('title', 'Lethal Company')->first();

        // Attach categories if they exist (safety check)
        if ($eldenRing) $eldenRing->categories()->attach([$goty->id, $rpg->id, $art->id, $playersChoice->id]);
        if ($gow) $gow->categories()->attach([$goty->id, $narrative->id, $action->id, $soundtrack->id]);
        if ($zelda) $zelda->categories()->attach([$goty->id, $action->id, $innovation->id, $playersChoice->id]);
        if ($bg3) $bg3->categories()->attach([$goty->id, $rpg->id, $narrative->id, $playersChoice->id]);
        if ($cyberpunk) $cyberpunk->categories()->attach([$rpg->id, $narrative->id, $art->id]);
        
        if ($hollowKnight) $hollowKnight->categories()->attach([$indie->id, $art->id, $action->id]);
        if ($hades2) $hades2->categories()->attach([$indie->id, $action->id, $art->id]);
        
        if ($alanWake2) $alanWake2->categories()->attach([$narrative->id, $art->id, $soundtrack->id]);
        if ($ff16) $ff16->categories()->attach([$rpg->id, $soundtrack->id, $action->id]);
        
        if ($hifiRush) $hifiRush->categories()->attach([$action->id, $art->id, $soundtrack->id, $innovation->id]);
        if ($lethalCompany) $lethalCompany->categories()->attach([$indie->id, $multiplayer->id, $playersChoice->id]);
    }
}
