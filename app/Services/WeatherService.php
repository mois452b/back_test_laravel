<?php

namespace App\Services;

class WeatherService
{
    public static function getForecastDatas( array $cities, int $days ) {
        $apiKey = 'b9cc4f4f3510e8c6130611073844c1e6';
        $forecastData = [];

        foreach ($cities as $city) {
            $url = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&cnt={$days}&appid={$apiKey}";
            $response = file_get_contents($url);
            $data = json_decode($response, true);
            $forecastData[] = $data;
        }

        return $forecastData;
    }
}
