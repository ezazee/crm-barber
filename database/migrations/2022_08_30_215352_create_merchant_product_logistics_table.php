<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantProductLogisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_product_logistics', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('merchant_product_id')->unsigned();
            $table->bigInteger('merchant_has_logistic_id')->unsigned()->nullable();
            $table->bigInteger('local_has_logistic_id')->unsigned()->nullable();
            $table->timestamps();


            $table->foreign('merchant_product_id')
                ->references('id')
                ->on('merchant_products')
                ->onDelete('cascade');
            $table->foreign('local_has_logistic_id')
                ->references('id')
                ->on('local_has_logistics')
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
        Schema::dropIfExists('merchant_product_logistics');
    }
}
