<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CityController extends Controller
{
    public function search()
    {
        try {
            $response = Http::get('http://api.openweathermap.org/geo/1.0/direct', [
                'q' => request()->name,
                'limit' => 5,
                'appid' => config('openweathermap.app_id')
            ]);
    
            return $response->json();
        } catch (\Throwable $th) {
            abort(500, $th->getMessage());
        }
    }
}
