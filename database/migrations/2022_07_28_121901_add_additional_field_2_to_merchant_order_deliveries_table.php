<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalField2ToMerchantOrderDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_order_deliveries', function (Blueprint $table) {
            $table->string('logistic_source')->nullable()->after('logistic_name');
            $table->string('logistic_service_type')->nullable()->after('logistic_service_name');
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
            $table->dropColumn(['logistic_source', 'logistic_service_type']);
        });
    }
}
