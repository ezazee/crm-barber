<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\Type;

class ModifySomeDataTypeInMerchantOrderDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_order_deliveries', function (Blueprint $table) {
            $table->dropColumn([
                'logistic_service_cost_amount',
                'customer_coordinate_latitude',
                'customer_coordinate_longitude',
                'merchant_coordinate_latitude',
                'merchant_coordinate_longitude',
            ]);
        });
        Schema::table('merchant_order_deliveries', function (Blueprint $table) {
            $table->double('logistic_service_cost_amount')->after('logistic_service_cost_id');
            $table->decimal('customer_coordinate_longitude', 11, 8)->after('customer_coordinate_point')->nullable();
            $table->decimal('customer_coordinate_latitude', 10, 8)->after('customer_coordinate_point')->nullable();
            $table->decimal('merchant_coordinate_longitude', 11, 8)->after('merchant_coordinate_point')->nullable();
            $table->decimal('merchant_coordinate_latitude', 10, 8)->after('merchant_coordinate_point')->nullable();
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
                'logistic_service_cost_amount',
                'customer_coordinate_latitude',
                'customer_coordinate_longitude',
                'merchant_coordinate_latitude',
                'merchant_coordinate_longitude',
            ]);
        });
        Schema::table('merchant_order_deliveries', function (Blueprint $table) {
            $table->double('logistic_service_cost_amount')->after('logistic_service_cost_id');
            $table->string('customer_coordinate_longitude')->after('customer_coordinate_point')->nullable();
            $table->string('customer_coordinate_latitude')->after('customer_coordinate_point')->nullable();
            $table->string('merchant_coordinate_longitude')->after('merchant_coordinate_point')->nullable();
            $table->string('merchant_coordinate_latitude')->after('merchant_coordinate_point')->nullable();
        });
    }
}
