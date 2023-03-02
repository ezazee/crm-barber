<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->bigInteger('reference_id')->unsigned()->nullable();
            $table->bigInteger('owner_id')->unsigned();
            $table->string('owner_type'); // Customer, Merchant, Driver
            $table->bigInteger('client_id')->unsigned();
            $table->string('client_type'); // Customer, Merchant, Driver
            $table->boolean('is_online')->default(false)->nullable();
            $table->timestamp('last_seen')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('reference_id')
                ->references('id')
                ->on('chats')
                ->onDelete('cascade');
            $table->foreign('owner_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('client_id')
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
        Schema::dropIfExists('chats');
    }
}
