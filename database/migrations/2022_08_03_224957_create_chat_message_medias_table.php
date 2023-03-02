<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatMessageMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_message_medias', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('chat_message_id')->unsigned();
            $table->string('name');
            $table->string('link');
            $table->longText('caption')->nullable();
            $table->string('type')->nullable(); // image, video, etc
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('chat_message_id')
                ->references('id')
                ->on('chat_messages')
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
        Schema::dropIfExists('chat_message_medias');
    }
}
