<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->bigInteger('reference_id')->unsigned()->nullable();
            $table->bigInteger('chat_id')->unsigned();
            $table->string('type'); // text, image
            $table->boolean('from_me');
            $table->string('to')->index(); // destination -> chat ID
            $table->string('from')->index(); // sender -> chat ID
            $table->longText('body');
            $table->integer('ack')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('reference_id')
                ->references('id')
                ->on('chat_messages')
                ->onDelete('cascade');

            $table->foreign('chat_id')
                ->references('id')
                ->on('chats')
                ->onDelete('cascade');

            $table->foreign('to')
                ->references('uid')
                ->on('chats')
                ->onDelete('cascade');
            $table->foreign('from')
                ->references('uid')
                ->on('chats')
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
        Schema::dropIfExists('chat_messages');
    }
}
