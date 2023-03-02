<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('merchant_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->string('code')->unique();
            $table->date('date');
            $table->double('total_cart_price');
            $table->double('delivery_fee');
            $table->double('convenience_fee')->nullable();
            $table->double('handling_fee')->nullable();
            $table->double('discount_fee')->nullable();
            $table->double('total_price');
            $table->string('status');
            $table->string('airway_bill')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('merchant_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('merchant_orders');
    }
}
