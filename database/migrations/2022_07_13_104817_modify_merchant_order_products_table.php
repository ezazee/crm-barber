<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMerchantOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_order_products', function (Blueprint $table) {
            $table->bigInteger('product_variant_type_id_primary')->unsigned()->nullable();
            $table->string('variant_label_primary')->nullable();
            $table->string('variant_value_primary')->nullable();
            $table->bigInteger('product_variant_type_id_secondary')->unsigned()->nullable();
            $table->string('variant_label_secondary')->nullable();
            $table->string('variant_value_secondary')->nullable();
            $table->string('variant_slug')->nullable();
            $table->double('variant_price')->nullable();
            $table->bigInteger('variant_stock')->nullable();
            $table->string('variant_sku')->nullable();
            $table->string('variant_image_file')->nullable();
            $table->string('variant_image_file_link')->nullable();
            $table->string('variant_image_thumb_file')->nullable();
            $table->string('variant_image_thumb_file_link')->nullable();
        });
        Schema::table('merchant_order_product_variants', function (Blueprint $table) {
            $table->string('variant_slug')->nullable();
        });
        Schema::table('merchant_product_variants', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchant_order_products', function (Blueprint $table) {
            $table->dropColumn([
                'product_variant_type_id_primary',
                'variant_label_primary',
                'variant_value_primary',
                'product_variant_type_id_secondary',
                'variant_label_secondary',
                'variant_value_secondary',
                'variant_slug',
                'variant_price',
                'variant_stock',
                'variant_sku',
                'variant_image_file',
                'variant_image_file_link',
                'variant_image_thumb_file',
                'variant_image_thumb_file_link',
            ]);
        });
        Schema::table('merchant_order_product_variants', function (Blueprint $table) {
            $table->dropColumn([
                'variant_slug'
            ]);
        });
        Schema::table('merchant_product_variants', function (Blueprint $table) {
            $table->dropColumn([
                'slug'
            ]);
        });
    }
}
