<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('local_id')->unsigned()->nullable();
            $table->bigInteger('merchant_level_id')->unsigned()->nullable();
            $table->string('name');
            $table->text('about')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_link')->nullable();
            $table->string('logo_thumb')->nullable();
            $table->string('logo_thumb_link')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('local_id')
                ->references('id')
                ->on('locals')
                ->onDelete('cascade');
            $table->foreign('merchant_level_id')
                ->references('id')
                ->on('merchant_levels')
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
        Schema::dropIfExists('merchants');
    }
}
