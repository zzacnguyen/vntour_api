<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVntDistrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vnt_district', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district_name', 50);
            $table->integer('province_city_id')->unsigned();
            $table->tinyInteger('enable');
            $table->foreign('province_city_id')->references('id')->on('vnt_province_city')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vnt_district');
    }
}
