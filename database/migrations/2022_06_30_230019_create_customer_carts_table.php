<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_carts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('merchant_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            // $table->bigInteger('merchant_product_id')->unsigned();
            // $table->bigInteger('quantity')->default(1);
            $table->bigInteger('coupon_code_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('merchant_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('customer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            // $table->foreign('merchant_product_id')
            //     ->references('id')
            //     ->on('merchant_products')
            //     ->onDelete('cascade');

            $table->foreign('coupon_code_id')
                ->references('id')
                ->on('coupon_codes')
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
        Schema::dropIfExists('customer_carts');
    }
}
