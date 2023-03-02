<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStatusFieldInMerchantOrderRelatedTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // merchant_orders
        Schema::table('merchant_orders', function (Blueprint $table) {
            $table->dropColumn([
                'status'
            ]);
        });
        Schema::table('merchant_orders', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->after('code'); // 0: Pending, etc etc
        });

        // merchant_order_deliveries
        Schema::table('merchant_order_deliveries', function (Blueprint $table) {
            $table->dropColumn([
                'status'
            ]);
        });
        Schema::table('merchant_order_deliveries', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->after('merchant_order_id'); // 0: Pending, etc etc
        });
        // merchant_order_payments
        Schema::table('merchant_order_payments', function (Blueprint $table) {
            $table->dropColumn([
                'status'
            ]);
        });
        Schema::table('merchant_order_payments', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->after('order_total_price'); // 0: Unpaid, etc etc
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // merchant_orders
        Schema::table('merchant_orders', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
        Schema::table('merchant_orders', function (Blueprint $table) {
            $table->string('status')->after('code');
        });

        // merchant_order_deliveries
        Schema::table('merchant_order_deliveries', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
        Schema::table('merchant_order_deliveries', function (Blueprint $table) {
            $table->string('status')->after('merchant_order_id');
        });

        // merchant_order_payments
        Schema::table('merchant_order_payments', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });
        Schema::table('merchant_order_payments', function (Blueprint $table) {
            $table->string('status')->after('order_total_price');
        });
    }
}
