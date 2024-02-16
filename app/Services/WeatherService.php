<?php

namespace App\Services;

class WeatherService
{
    public static function getForecastDatas( array $cities, int $days ) {
        $apiKey = env('OPENWEATHERMAP_PUBLIC_KEY');
        $forecastData = [];

        foreach ($cities as $city) {
            $url = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&cnt={$days}&appid={$apiKey}";
            $response = file_get_contents($url);
            $data = json_decode($response, true);
            $forecastData[] = $data;
        }

        return $forecastData;
    }

    public static function getWeatherDatas( array $cities ) {
        $apiKey = env('OPENWEATHERMAP_PUBLIC_KEY');
        $weatherDatas = [];

        foreach ($cities as $city) {
            $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}";
            $response = file_get_contents($url);
            $data = json_decode($response, true);
            $weatherDatas[] = $data;
        }

        return $weatherDatas;
    }
}
