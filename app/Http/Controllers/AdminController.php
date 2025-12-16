<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('games')->get();
        return view('admin.dashboard', compact('categories'));
    }
}
