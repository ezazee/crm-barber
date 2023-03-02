<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidehailDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ridehail_drivers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('ridehail_id')->unsigned();
            $table->bigInteger('driver_id')->unsigned();
            $table->integer('status'); // 0: Waiting to be Picked up, 1: On the way to the Destination, 3: Arrived at the Destination, 3: Etc etc
            $table->timestamp('start_ride');
            $table->timestamp('end_ride')->nullable();
            $table->float('rate_number')->nullable(); // 1, 1.5, 2, 3, 5
            $table->string('rate_tags')->nullable(); // Eg: Pelayanan Baik, Komunikatif, Ramah, Cepat Sampai, Pemilihan Jalan Oke, dll
            $table->longText('rate_messages')->nullable();
            $table->integer('rate_flag')->nullable(); // 1: Safe, 2: Spam
            $table->timestamps();

            $table->foreign('ridehail_id')
                ->references('id')
                ->on('ridehails')
                ->onDelete('cascade');
            $table->foreign('driver_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('ridehail_drivers');
    }
}
