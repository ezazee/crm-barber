<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTripayNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tripay_notifications', function (Blueprint $table) {
            $table->dropConstrainedForeignId('merchant_order_id');
            $table->dropConstrainedForeignId('merchant_order_payment_id');
            $table->string('payment_reference')->after('uuid'); // tripay merchant_ref
            $table->string('payment_type')->after('uuid'); // Customer Order, Customer Topup, Driver Topup
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tripay_notifications', function (Blueprint $table) {
            $table->bigInteger('merchant_order_id')->unsigned()->nullable();
            $table->bigInteger('merchant_order_payment_id')->unsigned()->nullable();

            $table->foreign('merchant_order_id')
                ->references('id')
                ->on('merchant_orders')
                ->onDelete('set null');
            $table->foreign('merchant_order_payment_id')
                ->references('id')
                ->on('merchant_order_payments')
                ->onDelete('set null');

            $table->dropColumn([
                'payment_reference',
                'payment_type',
            ]);
        });
    }
}
