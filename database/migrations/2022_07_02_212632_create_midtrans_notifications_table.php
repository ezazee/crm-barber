<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMidtransNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('midtrans_notifications', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('merchant_order_id')->unsigned()->nullable();
            $table->bigInteger('merchant_order_payment_id')->unsigned()->nullable();
            $table->string('midtrans_transaction_id');
            $table->string('midtrans_transaction_status');
            $table->json('midtrans_notification_data');
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
        Schema::dropIfExists('midtrans_notifications');
    }
}
