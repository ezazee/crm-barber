<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldToMerchantOrderDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_order_deliveries', function (Blueprint $table) {
            $table->string('logistic_service_estimation_duration')->after('logistic_service_cost_for_distance')->nullable(); // in days
            $table->string('logistic_service_cost_for_region_type')->after('logistic_service_cost_for_distance')->nullable(); // Province, Regency, District
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
            $table->dropColumn(['logistic_service_cost_for_region_type', 'logistic_service_estimation_duration']);
        });
    }
}
