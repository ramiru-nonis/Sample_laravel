<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\YouTubeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// YouTube API Routes
Route::get('/youtube', [YouTubeController::class, 'index'])->name('youtube.index');
Route::get('/youtube/video/{id}', [YouTubeController::class, 'show'])->name('youtube.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/hello', function () {
        return response()->json(['message' => 'hello']);
    })->name('hello');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin-only Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return response()->json([
            'message' => 'Welcome to the Admin Dashboard!',
            'user' => auth()->user(),
        ]);
    })->name('admin.dashboard');
});

require __DIR__ . '/auth.php';

