<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidehailLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ridehail_locations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('ridehail_id')->unsigned();
            $table->integer('status')->nullable();
            $table->string('pickup_location_name');
            $table->string('pickup_location_address');
            $table->point('pickup_location_coordinate');
            $table->string('pickup_location_notes');
            $table->string('destination_location_name');
            $table->string('destination_location_address');
            $table->point('destination_location_coordinate');
            $table->string('destination_location_notes');
            $table->double('distance_estimation');
            $table->string('distance_unit');
            $table->double('time_estimation');
            $table->string('time_unit');
            $table->double('ride_hailing_fee');

            // LOGISTIC
            $table->bigInteger('logistic_id')->unsigned()->nullable();
            $table->string('logistic_name');
            $table->bigInteger('logistic_service_id')->unsigned()->nullable();
            $table->string('logistic_service_name');
            $table->bigInteger('logistic_service_cost_id')->unsigned()->nullable();
            $table->string('logistic_service_cost_amount');
            $table->enum('logistic_service_cost_type', ['By Distance', 'By Region']);
            $table->float('logistic_service_cost_for_distance')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ridehail_id')
                ->references('id')
                ->on('ridehails')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ridehail_locations');
    }
}
