<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripayNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tripay_notifications', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('merchant_order_id')->unsigned()->nullable();
            $table->bigInteger('merchant_order_payment_id')->unsigned()->nullable();
            $table->string('tripay_transaction_id'); // reference
            $table->string('tripay_transaction_status');
            $table->json('tripay_notification_data'); // tripay raw data
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('merchant_order_id')
                ->references('id')
                ->on('merchant_orders')
                ->onDelete('set null');
            $table->foreign('merchant_order_payment_id')
                ->references('id')
                ->on('merchant_order_payments')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tripay_notifications');
    }
}
