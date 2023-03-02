<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
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
            $table->bigInteger('local_id')->unsigned()->nullable();
            $table->bigInteger('merchant_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('local_id')
                ->references('id')
                ->on('locals')
                ->onDelete('cascade');
            $table->foreign('merchant_id')
                ->references('id')
                ->on('merchants')
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
        Schema::dropIfExists('coupons');
    }
}
