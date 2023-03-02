<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
            - table ini hanya sebatas halaman page / blog, yang berisi content dan penjelasan terkait promosi
            - pada pengembangannya mungkin akan ada penambahan antara field atau table relasi lainnya
        */
        Schema::create('local_promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content')->nullable();
            $table->tinyInteger('status'); // 0: Draft | 1: Published
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('cover_file');
            $table->string('cover_file_link');
            $table->string('cover_thumb_file')->nullable();
            $table->string('cover_thumb_file_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_promotions');
    }
}
