<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    public function getForecast(Request $request)
    {
        $request->validate([
            'cities' => 'required|array',
            'days' => 'required|integer',
        ]);

        $cities = $request->input('cities');
        $days = $request->input('days');

        $forecastData = WeatherService::getForecastData( $cities, $days );

        return response()->json($forecastData);
    }
}
