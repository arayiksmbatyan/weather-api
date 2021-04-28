<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityMeta extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'city_metas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'city_id',
        'timezone',
        'temp',
        'pressure',
        'humidity',
        'temp_min',
        'temp_max',
    ];
}
