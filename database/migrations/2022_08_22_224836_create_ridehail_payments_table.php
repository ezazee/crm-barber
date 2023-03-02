<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidehailPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ridehail_payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('ridehail_id')->unsigned();
            $table->double('total_price');
            $table->integer('status'); // 0: Unpaid, 1: Paid, 2: Expired, 3: Failed, 4: etc etc
            $table->bigInteger('payment_method_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('code');
            $table->enum('fee_type', ['Fixed', 'Percent']);
            $table->double('fee');
            $table->double('fee_nominal');
            $table->enum('fee_additional_type', ['Fixed', 'Percent'])->nullable();
            $table->double('fee_additional')->nullable();
            $table->double('fee_additional_nominal')->nullable();
            $table->double('fee_total');
            $table->string('image_file');
            $table->string('image_file_link');
            $table->timestamp('expired_at');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ridehail_id')
                ->references('id')
                ->on('ridehails')
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
        Schema::dropIfExists('ridehail_payments');
    }
}
