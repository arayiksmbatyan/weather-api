<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\CityMeta;
use Illuminate\Console\Command;


class WeatherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:get-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get weather data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $cities = City::all();

        foreach ($cities as $city) {

            $latitude = $city->latitude;
            $longitude = $city->longitude;
            $apiKey = env('WEATHER_API_KEY');

            try {
                $client = new \GuzzleHttp\Client();
                $url = "https://api.openweathermap.org/data/2.5/weather?lat={$latitude}&lon={$longitude}&appid={$apiKey}&units=metric";
                $result = $client->get($url);
                $result = json_decode($result->getBody());
                $data = [
                    'timezone' => $result->timezone,
                    'temp' => $result->main->temp,
                    'pressure' => $result->main->pressure,
                    'humidity' => $result->main->humidity,
                    'temp_min' => $result->main->temp_min,
                    'temp_max' => $result->main->temp_max,
                ];       

                CityMeta::updateOrCreate(
                    ['city_id' => $city->id],
                    $data
                );
            } catch (\Throwable $th) {
                $this->error($th->getMessage());
            }
        }
    }
}