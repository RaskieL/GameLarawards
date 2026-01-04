<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;

// Public route for the homepage
Route::get('/', function () {
    return view('welcome');
});

// Dashboard for logged-in and verified users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes for logged-in users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin-only routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('admin/categories', \App\Http\Controllers\AdminCategoryController::class)->except(['index']);
    Route::resource('admin/games', \App\Http\Controllers\AdminGameController::class);
});

// Voting routes for normal users
Route::middleware('auth')->group(function () {
    Route::get('/user', [VoteController::class, 'index'])->name('user.index');
    Route::post('/user/vote', [VoteController::class, 'store'])->name('user.store');
    Route::delete('/user/vote/{category}', [VoteController::class, 'clearVote'])->name('user.clear-vote');
    Route::get('/user/results', [VoteController::class, 'results'])->name('user.results');
});

// Authentication routes (login, register, etc.)
require __DIR__ . '/auth.php';