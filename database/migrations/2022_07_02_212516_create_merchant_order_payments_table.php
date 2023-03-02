<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_order_payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('merchant_order_id')->unsigned();
            $table->string('provider'); // Midtrans, Xendit, etc
            $table->string('order_total_price');
            $table->string('status');
            $table->bigInteger('payment_method_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('code');
            $table->string('group');
            $table->double('minimum_payment');
            $table->enum('fee_type', ['Fixed', 'Percent']);
            $table->double('fee');
            $table->boolean('is_third_party');
            $table->string('image_file');
            $table->string('image_file_link');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('merchant_order_id')
                ->references('id')
                ->on('merchant_orders')
                ->onDelete('cascade');
            $table->foreign('payment_method_id')
                ->references('id')
                ->on('payment_methods')
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
        Schema::dropIfExists('merchant_order_payments');
    }
}
