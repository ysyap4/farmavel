<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('med_id')->unsigned();
            $table->foreign('med_id')->references('id')->on('medicine');
            $table->string('vas_availability_batupahat');
            $table->string('vas_availability_johorbahru');
            $table->string('vas_availability_muar');
            $table->string('vas_availability_segamat');
            $table->string('vas_availability_kulaijaya');
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
        Schema::dropIfExists('vas');
    }
}
