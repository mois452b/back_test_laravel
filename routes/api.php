<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WeatherController;
use App\Http\Controllers\ImageController;

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

Route::get('marvels/', function() {
    $apikey = '5fdd8d0d12ae268069a79a205bb738fe';
    $privateKey = 'd045b4029f83a62dfb0502b253b2ca6934f3cab1';
    $ts = time();
    $hash = md5($ts . $privateKey . $apikey);

    $baseUrl = 'https://gateway.marvel.com/v1/public/';
    $seriesEndpoint = 'series';
    $seriesUrl = $baseUrl . $seriesEndpoint . '?apikey=' . $apikey . '&ts=' . $ts . '&hash=' . $hash;

    $curlSeries = curl_init($seriesUrl);

    curl_setopt($curlSeries, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlSeries, CURLOPT_SSL_VERIFYPEER, false);
    
    $seriesResponse = curl_exec($curlSeries);

    curl_close($curlSeries);

    $seriesData = json_decode($seriesResponse, true);

    if (isset($seriesData['data']) && isset($seriesData['data']['results'])) {
        $series = $seriesData['data']['results'];
        return $series;
    }

    return [];
});

Route::post('images', [ImageController::class, 'getImageData']);

Route::post('weather', [WeatherController::class, 'getWeathers']);
Route::post('weather/forecast', [WeatherController::class, 'getForecasts']);
