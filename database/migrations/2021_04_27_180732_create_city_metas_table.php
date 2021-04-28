<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_metas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id');
            $table->integer('timezone');
            $table->integer('temp');
            $table->integer('pressure');
            $table->integer('humidity');
            $table->integer('temp_min');
            $table->integer('temp_max');
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city_metas');
    }
}
