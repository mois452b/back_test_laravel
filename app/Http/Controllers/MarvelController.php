<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarvelAdapter;

class MarvelController extends Controller {
    
    public static function getSeries( Request $request ) {
        $apikey = env('MARVEL_PUBLIC_KEY');
        $privateKey = env('MARVEL_PRIVATE_KEY');
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
            
            $series = array_map( function( $data ) {
                $data['mediaType'] = 'series';
                return MarvelAdapter::seriesData( $data );
            }, $series );

            return response()->json($series);
        }

        return response()->json([]);
    }

    public static function getMovies( Request $request ) {
        return response()->json([]);
    }
}
