<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLogisticImageToMerchantOrderDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_order_deliveries', function (Blueprint $table) {
            $table->string('logistic_image_file')->nullable();
            $table->string('logistic_image_file_link')->nullable();
            $table->string('logistic_image_thumb_file')->nullable();
            $table->string('logistic_image_thumb_file_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchant_order_deliveries', function (Blueprint $table) {
            $table->dropColumn([
                'logistic_image_file',
                'logistic_image_file_link',
                'logistic_image_thumb_file',
                'logistic_image_thumb_file_link',
            ]);
        });
    }
}
