<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarvelController extends Controller {
    
    public static function getSeries( Request $request ) {
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
            return response()->json($series);
        }

        return response()->json([]);
    }

    public static function getMovies( Request $request ) {
        return response()->json([]);
    }
}
