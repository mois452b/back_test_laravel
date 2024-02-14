<?php

use Illuminate\Http\Request;
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
    curl_setopt($curlSeries, CURLOPT_SSL_VERIFYPEER, false); // Desactiva la verificación SSL (solo para pruebas)

    $seriesResponse = curl_exec($curlSeries);

    curl_close($curlSeries);

    $seriesData = json_decode($seriesResponse, true);

    if (isset($seriesData['data']) && isset($seriesData['data']['results'])) {
        $series = $seriesData['data']['results'];
        return $series;
    }

    return [];
});

Route::post('images', function( Request $request ) {
    // Validar la solicitud y asegurarse de que se haya enviado una imagen
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ajusta los formatos y el tamaño máximo según tus necesidades
    ]);

    // Obtener la imagen del request
    $image = $request->file('image');

    // Obtener información básica de la imagen
    $imageName = $image->getClientOriginalName();
    $imageSize = $image->getSize();
    $imageFormat = $image->getClientOriginalExtension();

    // Obtener dimensiones de la imagen
    list($width, $height) = getimagesize($image);

    // Procesar cualquier otra información que necesites aquí

    // Devolver la información de la imagen como JSON
    return response()->json([
        'name' => $imageName,
        'size' => $imageSize,
        'format' => $imageFormat,
        'width' => $width,
        'height' => $height,
        // Agrega cualquier otra información que desees retornar
    ]);
});

Route::get('peoples', function() {
    return 'peoples';
});