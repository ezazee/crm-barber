<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_balances', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('local_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('user_type');
            $table->double('balance_total');
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_balances');
    }
}
