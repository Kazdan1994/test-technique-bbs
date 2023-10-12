<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstagramController;

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

Route::get('/', [InstagramController::class, 'index'])->name('instagram.home');
Route::get('oauth', [InstagramController::class, 'loginInstagram'])
    ->name('instagram.login');
Route::get('oauth/callback/instagram', [InstagramController::class, 'instagramCallback']);
Route::get('fetch-posts-instagram', [InstagramController::class, 'instagramFetchPost'])
    ->name('instagram.instagramFetchPost');
Route::get('instagram-feeds', [InstagramController::class, 'instagramFeed']);
