<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantEtalaseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_etalase_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('merchant_etalase_id')->unsigned();
            $table->bigInteger('merchant_product_id')->unsigned();
            $table->timestamps();

            $table->foreign('merchant_etalase_id')
                ->references('id')
                ->on('merchant_etalases')
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
        Schema::dropIfExists('merchant_etalase_products');
    }
}
