<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCostForRegionTypeFieldToLogisticServiceCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logistic_service_costs', function (Blueprint $table) {
            $table->string('cost_for_region_type')->after('cost_for_distance')->nullable(); // Province, Regency, District
            $table->string('estimation_duration')->after('cost_for_region_type')->nullable(); // in days
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('logistic_service_costs', function (Blueprint $table) {
            $table->dropColumn(['cost_for_region_type', 'estimation_duration']);
        });
    }
}
