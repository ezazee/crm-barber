<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTopupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_topups', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('local_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('user_type');
            $table->bigInteger('payment_method_id')->unsigned()->nullable();
            $table->string('payment_method_provider');
            $table->string('payment_method_name');
            $table->string('payment_method_code');
            $table->double('payment_method_fee_total');
            $table->string('topup_code');
            $table->double('topup_amount');
            $table->double('topup_bill_amount');
            $table->integer('status'); // 0: Unpaid, 1: Paid
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('local_id')
                ->references('id')
                ->on('locals')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('payment_method_id')
                ->references('id')
                ->on('local_has_payment_methods')
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
        Schema::dropIfExists('user_topups');
    }
}
