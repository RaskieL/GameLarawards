<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    /**
     * Display the voting page with categories and user's votes.
     */
    public function index()
    {
        // Get categories with related games
        $categories = Category::with('games')->get();

        // Get current user's votes as array: category_id => game_id
        $userVotes = Auth::user()->votes()->pluck('game_id', 'category_id')->toArray();

        return view('user.index', compact('categories', 'userVotes'));
    }

    /**
     * Store or update a user's vote for a category.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'game_id' => 'required|exists:games,id',
        ]);

        // Delete previous vote from user in this category (using relationship)
        Auth::user()->votes()->where('category_id', $request->category_id)->delete();

        // Create new vote
        Auth::user()->votes()->create([
            'category_id' => $request->category_id,
            'game_id' => $request->game_id,
        ]);

        return back()->with('success', 'Vote submitted successfully!');
    }

    /**
     * Clear the user's vote for a specific category.
     */
    public function clearVote(Category $category)
    {
        // Delete user's votes in this category (using relationship)
        Auth::user()->votes()->where('category_id', $category->id)->delete();

        return back()->with('success', 'Vote removed successfully!');
    }

    /**
     * Display voting results with vote counts per game.
     */
    public function results()
    {
        $categories = Category::all();

        // Load games for each category with vote count specific to that category
        foreach ($categories as $category) {
            $games = $category->games()
                ->withCount(['votes' => function ($query) use ($category) {
                    $query->where('category_id', $category->id);
                }])
                ->orderBy('votes_count', 'desc')
                ->get();
            
            $category->setRelation('games', $games);
        }

        return view('user.results', compact('categories'));
    }
}