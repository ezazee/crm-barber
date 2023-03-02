<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidehailGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ridehail_goods', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('ridehail_id')->unsigned();
            $table->double('weight')->nullable();
            $table->double('volume_length')->nullable();
            $table->double('volume_width')->nullable();
            $table->double('volume_height')->nullable();
            $table->string('recipient_name')->nullable();
            $table->string('recipient_phone')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ridehail_id')
                ->references('id')
                ->on('ridehails')
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
        Schema::dropIfExists('ridehail_goods');
    }
}
