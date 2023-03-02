<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantOrderDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_order_deliveries', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('merchant_order_id')->unsigned();
            $table->string('status');

            // LOGISTIC
            $table->bigInteger('logistic_id')->unsigned()->nullable();
            $table->string('logistic_name');
            $table->bigInteger('logistic_service_id')->unsigned()->nullable();
            $table->string('logistic_service_name');
            $table->bigInteger('logistic_service_cost_id')->unsigned()->nullable();
            $table->string('logistic_service_cost_amount');
            $table->enum('logistic_service_cost_type', ['By Distance', 'By Region']);
            $table->float('logistic_service_cost_for_distance')->nullable();

            // CUSTOMER ADDRESS
            $table->bigInteger('customer_address_id')->unsigned()->nullable();
            $table->string('customer_address');
            $table->string('customer_recipient_name')->nullable();
            $table->string('customer_recipient_phone')->nullable();
            $table->bigInteger('customer_province_id')->unsigned()->nullable();
            $table->string('customer_province_name')->nullable();
            $table->bigInteger('customer_regency_id')->unsigned()->nullable();
            $table->string('customer_regency_name');
            $table->bigInteger('customer_district_id')->unsigned()->nullable();
            $table->string('customer_district_name');
            $table->bigInteger('customer_village_id')->unsigned()->nullable();
            $table->string('customer_village_name')->nullable();
            $table->string('customer_postal_code')->nullable();

            // CUSTOMER COORDINATE (especially for instant delivery and by distance cost)
            $table->string('customer_notes')->nullable();
            $table->string('customer_coordinate_location')->nullable();
            $table->float('customer_coordinate_latitude')->nullable();
            $table->float('customer_coordinate_longitude')->nullable();
            $table->point('customer_coordinate_point')->nullable();

            // MERCHANT ADDRESS
            $table->bigInteger('merchant_address_id')->unsigned()->nullable();
            $table->string('merchant_address');
            $table->bigInteger('merchant_province_id')->unsigned()->nullable();
            $table->string('merchant_province_name')->nullable();
            $table->bigInteger('merchant_regency_id')->unsigned()->nullable();
            $table->string('merchant_regency_name');
            $table->bigInteger('merchant_district_id')->unsigned()->nullable();
            $table->string('merchant_district_name');
            $table->bigInteger('merchant_village_id')->unsigned()->nullable();
            $table->string('merchant_village_name')->nullable();
            $table->string('merchant_postal_code')->nullable();

            // MERCHANT COORDINATE (especially for instant delivery and by distance cost)
            $table->string('merchant_coordinate_location')->nullable();
            $table->float('merchant_coordinate_latitude')->nullable();
            $table->float('merchant_coordinate_longitude')->nullable();
            $table->point('merchant_coordinate_point')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('merchant_order_id')
                ->references('id')
                ->on('merchant_orders')
                ->onDelete('cascade');

            $table->foreign('logistic_id')
                ->references('id')
                ->on('logistics')
                ->onDelete('set null');
            $table->foreign('logistic_service_id')
                ->references('id')
                ->on('logistic_services')
                ->onDelete('set null');
            $table->foreign('logistic_service_cost_id')
                ->references('id')
                ->on('logistic_service_costs')
                ->onDelete('set null');

            $table->foreign('customer_address_id')
                ->references('id')
                ->on('customer_addresses')
                ->onDelete('set null');
            $table->foreign('customer_province_id')
                ->references('id')
                ->on('provinces')
                ->onDelete('set null');
            $table->foreign('customer_regency_id')
                ->references('id')
                ->on('regencies')
                ->onDelete('set null');
            $table->foreign('customer_district_id')
                ->references('id')
                ->on('districts')
                ->onDelete('set null');
            $table->foreign('customer_village_id')
                ->references('id')
                ->on('villages')
                ->onDelete('set null');

            $table->foreign('merchant_address_id')
                ->references('id')
                ->on('merchant_addresses')
                ->onDelete('set null');
            $table->foreign('merchant_province_id')
                ->references('id')
                ->on('provinces')
                ->onDelete('set null');
            $table->foreign('merchant_regency_id')
                ->references('id')
                ->on('regencies')
                ->onDelete('set null');
            $table->foreign('merchant_district_id')
                ->references('id')
                ->on('districts')
                ->onDelete('set null');
            $table->foreign('merchant_village_id')
                ->references('id')
                ->on('villages')
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
        Schema::dropIfExists('merchant_order_deliveries');
    }
}
