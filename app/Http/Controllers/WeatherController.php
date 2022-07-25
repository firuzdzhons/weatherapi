<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function searchCityByName()
    {
        $response = Http::get('http://api.openweathermap.org/geo/1.0/direct', [
            'q' => request()->name,
            'limit' => 5,
            'appid' => config('openweathermap.app_id')
        ]);

        return $response->json();
    }

    public function getWeatherData()
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'lat' => request()->lat,
            'lon' => request()->lon,
            'appid' => config('openweathermap.app_id')
        ]);

        return $response->json();
    }

}
