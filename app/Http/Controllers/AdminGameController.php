<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::with('categories')->paginate(10);
        return view('admin.games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $categories = Category::all();
        $selectedCategory = $request->query('category_id');
        return view('admin.games.create', compact('categories', 'selectedCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'developer' => 'required|string|max:255',
            'cover_image' => 'nullable|image|max:2048',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('games', 'public');
            $validated['cover_image'] = $path;
        } else {
            $validated['cover_image'] = 'https://placehold.co/600x400';
        }

        $game = Game::create($validated);

        if (isset($validated['categories'])) {
            $game->categories()->sync($validated['categories']);
        }

        if ($request->has('redirect_to_category')) {
            return redirect()->route('categories.show', $request->input('redirect_to_category'))->with('success', 'Game created successfully.');
        }

        return redirect()->route('games.index')->with('success', 'Game created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        return view('admin.games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Game $game)
    {
        $categories = Category::all();
        $fromCategory = $request->query('from_category');
        return view('admin.games.edit', compact('game', 'categories', 'fromCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'developer' => 'required|string|max:255',
            'cover_image' => 'nullable|image|max:2048',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($game->cover_image && !str_contains($game->cover_image, 'http')) {
                Storage::disk('public')->delete($game->cover_image);
            }
            $path = $request->file('cover_image')->store('games', 'public');
            $validated['cover_image'] = $path;
        }

        $game->update($validated);

        if (isset($validated['categories'])) {
            $game->categories()->sync($validated['categories']);
        }

        if ($request->has('redirect_to_category')) {
            return redirect()->route('categories.show', $request->input('redirect_to_category'))->with('success', 'Game updated successfully.');
        }

        return redirect()->route('games.index')->with('success', 'Game updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        if ($game->cover_image && !str_contains($game->cover_image, 'http')) {
            Storage::disk('public')->delete($game->cover_image);
        }
        $game->delete();

        return redirect()->route('games.index')->with('success', 'Game deleted successfully.');
    }
}
