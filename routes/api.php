<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('find-city', [WeatherController::class, 'searchCityByName']);
Route::get('get-weather-data', [WeatherController::class, 'getWeatherData']);

