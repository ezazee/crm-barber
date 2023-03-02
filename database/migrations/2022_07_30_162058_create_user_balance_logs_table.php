<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBalanceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_balance_logs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('user_balance_id')->unsigned();
            $table->string('log_type'); // In, Out
            $table->double('log_amount'); // in out amount
            $table->double('log_balance_total'); // current balance
            $table->string('log_notes')->nullable();
            $table->bigInteger('log_source_id')->unsigned()->nullable();
            $table->integer('log_source_type'); // 0: Pay, 1: Top-up, 2: Order Revenue, 3: Withdrawal, 4: Delivering Order etc
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_balance_id')
                ->references('id')
                ->on('user_balances')
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
        Schema::dropIfExists('user_balance_logs');
    }
}
