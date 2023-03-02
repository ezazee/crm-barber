<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('customer_id')->unsigned();
            $table->string('label');
            $table->string('recipient_name');
            $table->string('recipient_phone');
            $table->string('address')->nullable();
            $table->bigInteger('province_id')->unsigned()->nullable();
            $table->bigInteger('regency_id')->unsigned()->nullable();
            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->bigInteger('village_id')->unsigned()->nullable();
            $table->string('postal_code')->nullable();
            $table->point('coordinate_point')->nullable();
            $table->string('coordinate_location')->nullable();
            $table->boolean('is_main_address')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->onDelete('set null');
            $table->foreign('regency_id')
                ->references('id')
                ->on('regencies')
                ->onDelete('set null');
            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->onDelete('set null');
            $table->foreign('village_id')
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
        Schema::dropIfExists('customer_addresses');
    }
}
