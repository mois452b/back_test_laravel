<?php

namespace App\Services;

class WeatherAdapter {
    public static function weatherData( $data ) {
        return [
            'name' => $data['name'],
            'temp' => $data['main']['temp'],
            'description' => $data['weather'][0]['description'],
            'humidity' => $data['main']['humidity'],
            'pressure' => $data['main']['pressure'],
            'windSpeed' => $data['wind']['speed'],
        ];
    }

    public static function forecastData( $data ) {
        return [
            'name' => $data['city']['name'],
            'temp' => $data['list'][0]['main']['temp'],
            'description' => $data['list'][0]['weather'][0]['description'],
            'humidity' => $data['list'][0]['main']['humidity'],
            'pressure' => $data['list'][0]['main']['pressure'],
            'windSpeed' => $data['list'][0]['wind']['speed'],
        ];
    }
}