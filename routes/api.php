<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\GalleryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('configurations')->group(function () {
    Route::get('/', [ConfigurationController::class, 'index']);
    Route::get('/{key}', [ConfigurationController::class, 'show']);
});

Route::prefix('about-us')->group(function () {
    Route::get('/', [AboutUsController::class, 'index']);
    Route::get('/{slug}', [AboutUsController::class, 'show']);
});

Route::prefix('gallery')->group(function () {
    Route::get('/photo', [GalleryController::class, 'allPhoto']);
    Route::get('/video', [GalleryController::class, 'allVideo']);
});
