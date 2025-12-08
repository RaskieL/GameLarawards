<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("votes", function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor("\app\Models\User::class")->constrained()->cascadeOnDelete();
            $table->foreignIdFor("\app\Models\Game::class")->constrained()->cascadeOnDelete();
            $table->foreignIdFor("\app\Models\Category::class")->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("votes");
    }
};
