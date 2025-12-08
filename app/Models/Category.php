<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = "categories";

    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'description',
    ];

    public function games()
    {
        return $this->hasMany(\App\Models\Game::class);
    }
}
