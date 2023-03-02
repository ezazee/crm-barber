<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_order_products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('merchant_order_id')->unsigned();
            $table->string('name');
            $table->double('base_price');
            $table->enum('discount_type', ['Fixed', 'Percent'])->nullable();
            $table->double('discount_amount')->nullable();
            $table->double('discount_price')->nullable();
            $table->double('price');
            $table->bigInteger('order_quantity');
            $table->bigInteger('order_total_price');
            $table->string('notes')->nullable();
            $table->bigInteger('merchant_product_id')->unsigned()->nullable();
            $table->string('slug')->unique();
            $table->longText('description');
            $table->enum('condition', ['New', 'Second'])->default('New');
            $table->string('sku');
            $table->bigInteger('stock');
            $table->enum('weight_unit', ['Gram', 'Kilogram'])->default('Gram');
            $table->double('weight');
            $table->bigInteger('minimum_buy')->default(1);
            $table->string('cover_file');
            $table->string('cover_file_link');
            $table->string('cover_thumb_file')->nullable();
            $table->string('cover_thumb_file_link')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('merchant_order_id')
                ->references('id')
                ->on('merchant_orders')
                ->onDelete('cascade');
            $table->foreign('merchant_product_id')
                ->references('id')
                ->on('merchant_products')
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
        Schema::dropIfExists('merchant_order_products');
    }
}
