<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\City;
use App\Contracts\IWeatherService;

class WeatherService implements IWeatherService
{
    public function getData($name)
    {
        $query = City::query()->with('metas');

        if($name) {
            $query = $query->where('name', $name);
        }

        $data = $query->get();
        $now = Carbon::now()->timestamp;
        foreach ($data as $key => $value) {
            $data[$key]->time = Carbon::createFromTimestampUTC($now + $value->metas->timezone)->format("H:i"); 
        }

        return $data;
    }
}
