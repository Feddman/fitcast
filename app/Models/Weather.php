<?php

namespace App\Models;

use \Illuminate\Contracts\Support\Jsonable;
use \Illuminate\Support\Facades\Cache;

class Weather implements Jsonable
{
    const API_URL = 'https://api.openweathermap.org/data/2.5/';

    public $weather; // e.g: rain
    public $description; // e.g: moderate rain
    public $temperature; // e.g: 15.5
    public $feels_like; // e.g: 14.5
    public $temperature_min; // e.g: 15
    public $temperature_max; // e.g: 16
    public $pressure; // e.g: 1012
    public $humidity; // e.g: 93
    public $visibility; // e.g: 10000
    public $wind_speed; // e.g: 3.6
    public $icon; // e.g: 10d
    public $dateTime;
    public $fromCacheOriginalTime;

    public function toJson($options = 0) {
        return json_encode([
            'weather' => $this->weather,
            'description' => $this->description,
            'temperature' => $this->temperature,
            'feels_like' => $this->feels_like,
            'temperature_min' => $this->temperature_min,
            'temperature_max' => $this->temperature_max,
            'pressure' => $this->pressure,
            'humidity' => $this->humidity,
            'visibility' => $this->visibility,
            'wind_speed' => $this->wind_speed,
            'icon' => $this->icon,
            'dateTime' => $this->dateTime,
            'fromCacheOriginalTime' => $this->fromCacheOriginalTime
        ], $options);
    }

    private static function buildUrl($action = 'weather') {
        return self::API_URL . $action . '?appid=' . config('app.api_open_weather_key');
    }

    private static function loadFromCacheOrApi($url) {
        $cacheKey = 'weather_' . md5($url);
        $response = Cache::get($cacheKey, null);
        $cachedAt = $response !== null ? Cache::get($cacheKey . '_time', null) : null;

        if($response === null) {
            $response = @file_get_contents($url);

            if($response === false)
                return null;
            
            $cacheTime = \DateInterval::createFromDateString('1 hour');
            Cache::put($cacheKey, $response, $cacheTime);
            Cache::put($cacheKey . '_time', time(), $cacheTime);
        }

        return [
            'response' => $response,
            'cachedAt' => $cachedAt
        ];
    }

    public static function getAtCoordinates($latitude, $longitude, $whenUnixTimestamp = null) {
        if($whenUnixTimestamp === null) {
            return self::getAtCoordinatesNow($latitude, $longitude);
        }

        $whenUnixTimestamp = round($whenUnixTimestamp / 1800) * 1800;
        return self::getAtCoordinatesAt($latitude, $longitude, $whenUnixTimestamp);
    }

    private static function weatherFromApiData($data) {
        $weather = new Weather();

        $weather->weather = $data->weather[0]->main;
        $weather->description = $data->weather[0]->description;
        $weather->temperature = $data->main->temp;
        $weather->feels_like = $data->main->feels_like;
        $weather->temperature_min = $data->main->temp_min;
        $weather->temperature_max = $data->main->temp_max;
        $weather->pressure = $data->main->pressure;
        $weather->humidity = $data->main->humidity;
        $weather->visibility = $data->visibility;
        $weather->wind_speed = $data->wind->speed;
        $weather->dateTime = \Carbon\Carbon::createFromTimestamp($data->dt);
        $weather->icon = $data->weather[0]->icon;

        return $weather;
    }

    private static function getAtCoordinatesNow($latitude, $longitude) {
        $url = self::buildUrl() . '&lat=' . $latitude . '&lon=' . $longitude;
        $dataResult = self::loadFromCacheOrApi($url);

        if($dataResult['response'] === null)
            return null;
        
        $data = json_decode($dataResult['response']);

        $weather = self::weatherFromApiData($data);
        $weather->fromCacheOriginalTime = $dataResult['cachedAt'];
        return $weather;
    }

    private static function getAtCoordinatesAt($latitude, $longitude, $whenUnixTimestamp) {
        $url = self::buildUrl('forecast') . '&lat=' . $latitude . '&lon=' . $longitude;
        $dataResult = self::loadFromCacheOrApi($url);

        if($dataResult['response'] === null)
            return null;
        
        $data = json_decode($dataResult['response']);

        $weather = null;

        foreach($data->list as $forecast) {
            if($forecast->dt >= $whenUnixTimestamp) {
                $weather = self::weatherFromApiData($forecast);
                break;
            }
        }

        if($weather !== null)
            $weather->fromCacheOriginalTime = $dataResult['cachedAt'];
            
        return $weather;
    }
}