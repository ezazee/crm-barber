<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('driver_orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('driver_id')->unsigned();
            $table->bigInteger('merchant_order_id')->unsigned();
            $table->tinyInteger('status')->default(0)->nullable(); // 0: Taking, 1: Delivering, 2: Arrived, 3: Finish, etc
            $table->timestamp('start_delivery_at')->nullable();
            $table->timestamp('end_delivery_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('driver_id')
                ->references('id')
                ->on('drivers')
                ->onDelete('cascade');
            $table->foreign('merchant_order_id')
                ->references('id')
                ->on('merchant_orders')
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
        Schema::dropIfExists('driver_orders');
    }
}
