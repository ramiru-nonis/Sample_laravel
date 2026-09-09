<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\YouTubeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Static Pages & Demo Routes
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/greeting', function () {
    return view('greeting');
})->name('greeting');

Route::get('/color', function () {
    return view('color');
})->name('color');

Route::get('/result', function () {
    return view('result');
})->name('result');

Route::get('/demo/{id?}/{name?}', function ($id = 1, $name = 'Guest') {
    return view('demo', compact('id', 'name'));
})->name('demo');

// Movie Routes
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');


// User Registration Form Routes
Route::get('/form', [FormController::class, 'create'])->name('form.create');
Route::post('/form', [FormController::class, 'store'])->name('form.store');

// Products Resource Routes
Route::resource('products', ProductController::class);

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


