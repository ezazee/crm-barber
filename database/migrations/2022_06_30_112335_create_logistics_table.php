<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistics', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name');
            $table->string('short_name');
            $table->string('code');
            $table->string('image_file')->nullable();
            $table->string('image_file_link')->nullable();
            $table->string('image_thumb_file')->nullable();
            $table->string('image_thumb_file_link')->nullable();
            $table->string('scope');
            $table->string('source');
            $table->bigInteger('local_id')->unsigned()->nullable();
            $table->bigInteger('merchant_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('local_id')
                ->references('id')
                ->on('locals')
                ->onDelete('cascade');
            $table->foreign('merchant_id')
                ->references('id')
                ->on('merchants')
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
        Schema::dropIfExists('logistics');
    }
}
