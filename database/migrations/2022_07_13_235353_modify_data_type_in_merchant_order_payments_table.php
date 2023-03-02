<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDataTypeInMerchantOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_order_payments', function (Blueprint $table) {
            $table->dropColumn('order_total_price');
        });
        Schema::table('merchant_order_payments', function (Blueprint $table) {
            $table->double('order_total_price')->after('order_payment_code');
            $table->string('payment_url')->after('status')->nullable();
            $table->string('payment_number')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchant_order_payments', function (Blueprint $table) {
            $table->dropColumn('order_total_price');
        });
        Schema::table('merchant_order_payments', function (Blueprint $table) {
            $table->dropColumn('payment_number');
            $table->dropColumn('payment_url');
            $table->string('order_total_price')->after('order_payment_code');
        });
    }
}
