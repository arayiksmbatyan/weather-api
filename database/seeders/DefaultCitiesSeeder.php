<?php

namespace Database\Seeders;

use Artisan;
use App\Models\City;
use Illuminate\Database\Seeder;

class DefaultCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultCities = [
            [
                'name' => 'Yerevan',
                'latitude' => 40.18,
                'longitude' => 44.51,
            ],
            [
                'name' => 'Kapan',
                'latitude' => 39.21,
                'longitude' => 46.41,
            ]
        ];

        foreach ($defaultCities as $city) {
            City::create($city);
        }

        Artisan::call('weather:get-data');
    }
}
