<?php

use App\Http\Controllers\PageController;
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

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about-us/{slug}', [PageController::class, 'about'])->name('about');
Route::get('/gallery/{slug}', [PageController::class, 'gallery'])->name('gallery');
Route::get('/news/{slug}', [PageController::class, 'news'])->name('news');

Route::fallback(function ($e) {
    return redirect('/');
});
