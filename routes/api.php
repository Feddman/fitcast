<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// e.g: http://localhost:8000/api/v1/weather/51.571915/4.768323
Route::get('/weather/{latitude}/{longitude}', function($latitude, $longitude) {
    $weather = \App\Models\Weather::getAtCoordinates($latitude, $longitude);

    if($weather === null)
        return response()->json(['error' => 'Weather data could not be retrieved. OpenWeatherMap is not responding correctly.'], 500);

    return $weather;
});