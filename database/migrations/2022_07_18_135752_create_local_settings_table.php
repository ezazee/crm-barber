<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_settings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('local_setting_category_id')->unsigned()->nullable();
            $table->bigInteger('local_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('key');
            $table->longText('value');
            $table->string('input_type'); // text, number, textarea, file, etc
            $table->string('data_type'); // string, integer, json, binary-file, etc
            $table->string('description')->nullable();
            $table->tinyInteger('visibility')->default(0); // 0: Public, 1: Internal, 2: Private
            $table->boolean('is_editable')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('local_setting_category_id')
                ->references('id')
                ->on('local_setting_categories')
                ->onDelete('set null');
            $table->foreign('local_id')
                ->references('id')
                ->on('locals')
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
        Schema::dropIfExists('local_settings');
    }
}
