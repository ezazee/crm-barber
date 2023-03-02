<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyFieldAddressTypeInAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_addresses', function (Blueprint $table) {
            $table->dropColumn('is_main_address');
        });
        Schema::table('customer_addresses', function (Blueprint $table) {
            $table->boolean('is_main_address')->default(false)->after('coordinate_location');
        });
        Schema::table('merchant_addresses', function (Blueprint $table) {
            $table->dropColumn([
                'is_main_address',
                'is_pickup_address',
                'is_return_address',
            ]);
        });
        Schema::table('merchant_addresses', function (Blueprint $table) {
            $table->boolean('is_main_address')->default(false)->after('coordinate_location');
            $table->boolean('is_pickup_address')->default(false)->after('coordinate_location');
            $table->boolean('is_return_address')->default(false)->after('coordinate_location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_addresses', function (Blueprint $table) {
            $table->dropColumn('is_main_address');
        });
        Schema::table('customer_addresses', function (Blueprint $table) {
            $table->string('is_main_address')->default(false)->after('coordinate_location');
        });
        Schema::table('merchant_addresses', function (Blueprint $table) {
            $table->dropColumn([
                'is_main_address',
                'is_pickup_address',
                'is_return_address',
            ]);
        });
        Schema::table('merchant_addresses', function (Blueprint $table) {
            $table->string('is_main_address')->default(false)->after('coordinate_location');
            $table->string('is_pickup_address')->default(false)->after('coordinate_location');
            $table->string('is_return_address')->default(false)->after('coordinate_location');
        });
    }
}
