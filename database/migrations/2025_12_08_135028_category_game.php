<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("category_game", function (Blueprint $table) {
            $table->foreignIdFor("\App\Models\Model\Category::class")->constrained()->cascadeOnDelete();
            $table->foreignIdFor("\App\Models\Model\Game::class")->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("category_game");
    }
};
