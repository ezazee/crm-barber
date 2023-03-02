<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantOrderCouponCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_order_coupon_codes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('merchant_order_id')->unsigned();
            $table->bigInteger('coupon_code_id')->unsigned()->nullable();
            $table->string('code');
            $table->bigInteger('coupon_id')->unsigned()->nullable();
            $table->string('label');
            $table->string('description');
            $table->enum('discount_type', ['Fixed', 'Percent']);
            $table->double('discount_amount');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->enum('quota_type', ['Unlimited', 'Quota']);
            $table->bigInteger('quota_origin')->nullable();
            $table->bigInteger('quota_current')->nullable();
            $table->enum('usage_type', ['Multiple-time Use', 'One-time Use']);
            $table->enum('cut_type', ['Shipping', 'Billing']);
            $table->double('minimum_cart_price')->default(0);
            $table->double('maximum_cut_price')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('merchant_order_id', 'mocc_mo_id_foreign')
                ->references('id')
                ->on('merchant_orders')
                ->onDelete('cascade');
            $table->foreign('coupon_code_id', 'cc_mo_id_foreign')
                ->references('id')
                ->on('coupon_codes')
                ->onDelete('cascade');
            $table->foreign('coupon_id', 'coupons_mo_id_foreign')
                ->references('id')
                ->on('coupons')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_order_coupon_codes');
    }
}
