<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerCartProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_cart_products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('customer_cart_id')->unsigned();
            $table->bigInteger('merchant_product_id')->unsigned();
            $table->bigInteger('merchant_product_variant_id')->unsigned()->nullable();
            $table->bigInteger('quantity')->default(1);
            $table->timestamps();

            $table->foreign('customer_cart_id')
                ->references('id')
                ->on('customer_carts')
                ->onDelete('cascade');
            $table->foreign('merchant_product_id')
                ->references('id')
                ->on('merchant_products')
                ->onDelete('cascade');
            $table->foreign('merchant_product_variant_id')
                ->references('id')
                ->on('merchant_product_variants')
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
        Schema::dropIfExists('customer_cart_products');
    }
}
