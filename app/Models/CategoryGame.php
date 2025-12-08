<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
class CategoryGame extends Model
{
    protected $table = "category_game";

    /** @use HasFactory<\Database\Factories\CategoryGameFactory> */
    use HasFactory, Notifiable;
    protected $fillable = [
        'category_id',
        'game_id',
    ];
}
