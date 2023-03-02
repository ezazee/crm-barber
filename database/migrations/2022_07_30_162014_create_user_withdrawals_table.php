<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_withdrawals', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('local_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('user_type');
            $table->double('withdrawal_amount');
            $table->double('withdrawal_fee');
            $table->string('withdrawal_fee_type');
            $table->double('withdrawal_fee_nominal');
            $table->double('transfer_fee');
            $table->string('transfer_fee_type');
            $table->double('transfer_fee_nominal');
            $table->double('receive_amount');
            $table->bigInteger('user_bank_id')->unsigned()->nullable();
            $table->string('account_name');
            $table->string('account_number');
            $table->string('bank_name');
            $table->string('proof_file')->nullable();
            $table->string('proof_file_link')->nullable();
            $table->integer('status'); // 0: In Review, 1: Process, 2: Paid
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
            $table->foreign('user_bank_id')
                ->references('id')
                ->on('user_banks')
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
        Schema::dropIfExists('user_withdrawals');
    }
}
