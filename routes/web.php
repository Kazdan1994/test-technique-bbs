<?php

use App\Http\Controllers\InstagramController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [InstagramController::class, 'index'])->name('instagram.home');
    Route::get('oauth', [InstagramController::class, 'loginInstagram'])
        ->name('instagram.login');
    Route::get('oauth/callback/instagram', [InstagramController::class, 'instagramCallback']);
    Route::get('fetch-posts-instagram', [InstagramController::class, 'instagramFetchPost'])
        ->name('instagram.instagramFetchPost');
    Route::get('instagram-feeds', [InstagramController::class, 'instagramFeed'])
        ->name('instagram.instagramFeed');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
