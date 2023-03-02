<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_product_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('merchant_product_id')->unsigned();
            $table->bigInteger('product_category_id')->unsigned();
            $table->integer('depth_level')->default(1)->nullable();
            $table->timestamps();

            $table->foreign(
                'merchant_product_id',
                'mpct_merchant_product_id_foreign'
            )
                ->references('id')
                ->on('merchant_products')
                ->onDelete('cascade');
            $table->foreign(
                'product_category_id',
                'mpct_product_category_id_foreign'
            )
                ->references('id')
                ->on('product_categories')
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
        Schema::dropIfExists('merchant_product_has_product_categories');
    }
}
