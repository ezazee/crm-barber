<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->string('group');
            $table->double('minimum_payment');
            $table->enum('fee_type', ['Fixed', 'Percent']);
            $table->double('fee');
            $table->double('fee_additional')->nullable();
            $table->boolean('is_third_party');
            $table->string('image_file');
            $table->string('image_file_link');
            $table->boolean('active');
            $table->integer('order');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
}
