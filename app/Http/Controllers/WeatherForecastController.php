<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWeatherForecast;
use App\Http\Resources\WeatherForecastResource;
use App\Models\WeatherForecast;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class WeatherForecastController extends Controller
{
    public function store(StoreWeatherForecast $request) 
    {
        try {
            $weather = WeatherForecast::create(
                $request->validated()
            );

            return $weather->id;
        } catch (\Throwable $th) {
            abort(500, $th->getMessage());
        }   
    }

    public function show(WeatherForecast $weatherForecast) 
    {
        return new WeatherForecastResource($weatherForecast);
    }

    public function search()
    {
        try {
            $response = Http::get('https://api.openweathermap.org/data/2.5/forecast', [
                'q' => request()->q,
                'units' => 'metric',
                'appid' => config('openweathermap.app_id')
            ])->json();
    
            return $this->getOnlyAfternoonWeatherForecast($response);
        } catch (\Throwable $th) {
            abort(500, $th->getMessage());
        }
    }

    private function getOnlyAfternoonWeatherForecast($response)
    {
        if(!array_key_exists('list', $response)) {
            return [];
        }

        $result = [];

        $startDay = now()->hour(12)->minute(0)->second(0)->millisecond(0);

        foreach($response['list'] as $item) {
            if($startDay->eq(Carbon::parse($item['dt_txt']))){
                $item['day'] = $startDay->format('l');
                array_push($result, $item);
                $startDay->addDay();
            } 
        }

        $response['list'] = $result;

        return $response;
    }
}
