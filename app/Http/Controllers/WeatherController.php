<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;
use App\Services\WeatherAdapter;

class WeatherController extends Controller
{
    public function getForecasts(Request $request) {
        $request->validate([
            'cities' => 'required|array',
            'days' => 'required|integer',
        ]);

        $cities = $request->input('cities');
        $days = $request->input('days');

        $forecastData = WeatherService::getForecastDatas( $cities, $days );

        return response()->json($forecastData);
    }

    public function getWeathers(Request $request) {
        $request->validate([
            'cities' => 'required|array',
        ]);

        $cities = $request->input('cities');

        $weatherData = WeatherService::getWeatherDatas( $cities );

        $weatherData = array_map( function( $data ) {
            return WeatherAdapter::weatherData( $data );
        }, $weatherData );

        return response()->json($weatherData);
    }
}
