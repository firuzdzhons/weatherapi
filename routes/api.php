<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\WeatherForecastController;
use Illuminate\Support\Facades\Route;


Route::prefix('weather-forecast')->group(function () {
    Route::post('store', [WeatherForecastController::class, 'store']);
    Route::get('show/{weatherForecast}', [WeatherForecastController::class, 'show']);
    Route::get('search', [WeatherForecastController::class, 'search']);
});

Route::get('city/search', [CityController::class, 'search']);


