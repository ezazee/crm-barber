<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidehailCouponCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ridehail_coupon_codes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('ridehail_id')->unsigned();
            $table->bigInteger('coupon_code_id')->unsigned()->nullable();
            $table->string('code');
            $table->bigInteger('coupon_id')->unsigned()->nullable();
            $table->double('ridehail_discount_price')->default(0);
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
            $table->string('cut_type');
            $table->double('minimum_cart_price')->default(0);
            $table->double('maximum_cut_price')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ridehail_id')
                ->references('id')
                ->on('ridehails')
                ->onDelete('cascade');
            $table->foreign('coupon_code_id')
                ->references('id')
                ->on('coupon_codes')
                ->onDelete('cascade');
            $table->foreign('coupon_id')
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
        Schema::dropIfExists('ridehail_coupon_codes');
    }
}
