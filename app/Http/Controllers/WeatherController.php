<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    public function getForecasts(Request $request)
    {
        $request->validate([
            'cities' => 'required|array',
            'days' => 'required|integer',
        ]);

        $cities = $request->input('cities');
        $days = $request->input('days');

        $forecastData = WeatherService::getForecastDatas( $cities, $days );

        return response()->json($forecastData);
    }
}
