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
Route::get('/about-us/{type}', [PageController::class, 'about'])->name('about');
Route::get('/gallery/{type}', [PageController::class, 'gallery'])->name('gallery');
Route::prefix('news')->group(function () {
    Route::get('/{type}', [PageController::class, 'news'])->name('news');
    Route::get('/{type}/detail/{slug}', [PageController::class, 'detailNews'])->name('detail.news');
});
Route::match(['GET', 'POST'], 'contact', [PageController::class, 'contact'])->name('contact');
Route::get('/reload-captcha',  [PageController::class, 'reloadCaptcha'])->name('reload-captcha');
Route::prefix('program')->group(function () {
    Route::get('/{type}', [PageController::class, 'program'])->name('program');
    Route::get('/{type}/detail/{slug}', [PageController::class, 'detailProgram'])->name('detail.program');
});
Route::prefix('facility')->group(function () {
    Route::get('/{type}', [PageController::class, 'facility'])->name('facility');
    Route::get('/{type}/detail/{slug}', [PageController::class, 'detailFacility'])->name('detail.facility');
});

Route::fallback(function ($e) {
    return redirect('/');
});
