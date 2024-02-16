<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WeatherController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MarvelController;

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

Route::get('marvels/series', [MarvelController::class, 'getSeries']);
Route::get('marvels/movies', [MarvelController::class, 'getMovies']);

Route::post('images', [ImageController::class, 'getImageData']);

Route::post('weather', [WeatherController::class, 'getWeathers']);
Route::post('weather/forecast', [WeatherController::class, 'getForecasts']);
