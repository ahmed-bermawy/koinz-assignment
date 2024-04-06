<?php

use App\Http\Controllers\API\ReadingIntervalController;
use App\Http\Controllers\API\RecommendationController;
use Illuminate\Support\Facades\Route;

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

Route::post('/reading-intervals', [ReadingIntervalController::class, 'store'])->name('store');
Route::get('/recommendations', [RecommendationController::class, 'getMostRecommended'])->name('recommendations');
