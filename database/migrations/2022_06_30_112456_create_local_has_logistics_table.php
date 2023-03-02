<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalHasLogisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_has_logistics', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('local_id')->unsigned()->nullable();
            $table->bigInteger('logistic_id')->unsigned()->nullable();
            $table->boolean('active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->foreign('local_id')
                ->references('id')
                ->on('locals')
                ->onDelete('cascade');
            $table->foreign('logistic_id')
                ->references('id')
                ->on('logistics')
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
        Schema::dropIfExists('local_has_logistics');
    }
}
