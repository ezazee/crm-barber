<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_product_images', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('merchant_product_id')->unsigned()->nullable();
            $table->string('image_file');
            $table->string('image_file_link');
            $table->string('image_thumb_file')->nullable();
            $table->string('image_thumb_file_link')->nullable();
            $table->boolean('is_cover_image')->default(false);
            $table->timestamps();

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
        Schema::dropIfExists('merchant_product_images');
    }
}
