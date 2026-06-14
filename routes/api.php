<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\StickerController;

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/countries', [CountryController::class, 'index']);

Route::get('/stickers/section/{section}', [StickerController::class, 'bySection']);

Route::get('/stickers/section/{section}', [StickerController::class, 'bySection']);

Route::patch('/stickers/{id}/toggle', [StickerController::class, 'toggle']);
Route::get('/countries/{code}', [CountryController::class, 'show']);
Route::get('/search', [StickerController::class, 'search']);