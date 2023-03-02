<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidehailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ridehails', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('customer_id')->unsigned();
            $table->string('code');
            $table->integer('status'); // 0: Waiting to be Picked up, 1: On the way to the Destination, 3: Arrived at the Destination, 3: Etc etc
            $table->date('date');
            $table->double('ride_hailing_fee');
            $table->double('convenience_fee');
            $table->double('handling_fee');
            $table->double('discount_price');
            $table->double('total_price');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')
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
        Schema::dropIfExists('ridehails');
    }
}
