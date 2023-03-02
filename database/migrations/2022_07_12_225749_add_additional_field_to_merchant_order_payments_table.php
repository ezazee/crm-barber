<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldToMerchantOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_order_payments', function (Blueprint $table) {
            $table->double('fee_total')->after('fee')->nullable();
            $table->double('fee_additional_nominal')->after('fee')->nullable();
            $table->double('fee_nominal')->after('fee')->nullable();
            $table->enum('fee_additional_type', ['Fixed', 'Percent'])->after('fee')->nullable();
            $table->double('fee_additional')->after('fee')->nullable();
            $table->string('order_payment_code')->after('provider')->unique();
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
            $table->dropColumn('fee_additional_type');
            $table->dropColumn('fee_additional');
            $table->dropColumn('fee_total');
            $table->dropColumn('fee_nominal');
            $table->dropColumn('fee_additional_nominal');
            $table->dropColumn('order_payment_code');
        });
    }
}
