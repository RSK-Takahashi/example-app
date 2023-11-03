<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Sample
// Route::get('/sample', [\App\Http\Controllers\Sample\IndexController::class, 'show']);
// Route::get('/sample/{id}', [\App\Http\Controllers\Sample\tweet.index::class, 'showId']);
// Route::get('/tweet', \App\Http\Controllers\Tweet\IndexController::class);

// Tweet
// 75-5
Route::get('/tweet', \App\Http\Controllers\Tweet\IndexController::class)
->name('tweet.index');
// 136-32
Route::middleware('auth')->group(function () {
    // 74-4
    // Route::post('/tweet/create', \App\Http\Controllers\Tweet\CreateController::class);
    // 75-5
    Route::post('/tweet/create', \App\Http\Controllers\Tweet\CreateController::class)
    // 125-18
    // ->middleware('auth')
    ->name('tweet.create');

    // 85-02
    Route::get('/tweet/update/{tweetId}', \App\Http\Controllers\Tweet\Update\IndexController::class)
    ->name('tweet.update.index')->where('tweetId', '[0-9]+');
    Route::put('/tweet/update/{tweetId}', \App\Http\Controllers\Tweet\Update\PutController::class)
    ->name('tweet.update.put')->where('tweetId', '[0-9]+');

    // 94-01
    Route::delete('/tweet/delete/{tweetId}', \App\Http\Controllers\Tweet\DeleteController::class)
    ->name('tweet.delete');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
