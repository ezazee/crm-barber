<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_product_variants', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('merchant_product_id')->unsigned();
            $table->bigInteger('product_variant_type_id_primary')->unsigned();
            $table->string('label_primary');
            $table->string('value_primary');
            $table->bigInteger('product_variant_type_id_secondary')->unsigned()->nullable();
            $table->string('label_secondary')->nullable();
            $table->string('value_secondary')->nullable();
            $table->double('price');
            $table->bigInteger('stock');
            $table->string('sku')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('image_file')->nullable();
            $table->string('image_file_link')->nullable();
            $table->string('image_thumb_file')->nullable();
            $table->string('image_thumb_file_link')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('merchant_product_id')
                ->references('id')
                ->on('merchant_products')
                ->onDelete('cascade');
            $table->foreign('product_variant_type_id_primary', 'mpv_pvt_id_primary_foreign')
                ->references('id')
                ->on('product_variant_types')
                ->onDelete('cascade');
            $table->foreign('product_variant_type_id_secondary', 'mpv_pvt_id_secondary_foreign')
                ->references('id')
                ->on('product_variant_types')
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
        Schema::dropIfExists('merchant_product_variants');
    }
}
