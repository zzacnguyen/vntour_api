<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVntTourGuideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vnt_tour_guide', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->primary('user_id');
            $table->integer('account_active');
            $table->string('user_objective_details');
            $table->string('user_strengths_details');
            $table->foreign('user_id')->references('user_id')->on('vnt_user')->onDelete('cascade');
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
        Schema::dropIfExists('vnt_tour_guide');
    }
}
