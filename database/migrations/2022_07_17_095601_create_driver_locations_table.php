<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('driver_locations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('driver_vehicle_id')->unsigned()->nullable();
            $table->boolean('is_active')->default(false);
            $table->tinyInteger('status')->default(0)->nullable(); // 0: Idle, 1: Taking Order, 2: Delivering Order, etc
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->bigInteger('driver_order_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('driver_vehicle_id')
                ->references('id')
                ->on('driver_vehicles')
                ->onDelete('set null');
            $table->foreign('driver_order_id')
                ->references('id')
                ->on('driver_orders')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_locations');
    }
}
