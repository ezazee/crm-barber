<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_vehicles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('driver_id')->unsigned();
            $table->string('category'); // Manual, Matic
            $table->string('brand'); // Honda, Yamaha, Toyota, etc
            $table->string('variant'); // Vario 125, Kijang Innova
            $table->year('year');
            $table->string('service_type'); // Bike, Car, Box
            $table->string('plate_number');
            $table->string('registration_file'); // STNK
            $table->string('registration_file_link');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_vehicles');
    }
}
