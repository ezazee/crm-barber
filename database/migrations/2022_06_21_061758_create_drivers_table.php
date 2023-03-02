<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('local_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->date('dob')->nullable(); // date of birth
            $table->string('religion')->nullable();
            $table->string('married_status')->nullable();

            $table->string('avatar')->nullable();
            $table->string('avatar_link')->nullable();
            $table->string('avatar_thumb')->nullable();
            $table->string('avatar_thumb_link')->nullable();

            $table->string('address')->nullable();
            $table->bigInteger('province_id')->unsigned()->nullable();
            $table->bigInteger('regency_id')->unsigned()->nullable();
            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->bigInteger('village_id')->unsigned()->nullable();
            $table->string('postal_code')->nullable();
            $table->point('coordinate_point')->nullable();
            $table->string('coordinate_location')->nullable();

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

            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->onDelete('set null');
            $table->foreign('regency_id')
                ->references('id')
                ->on('regencies')
                ->onDelete('set null');
            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->onDelete('set null');
            $table->foreign('village_id')
                ->references('id')
                ->on('villages')
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
        Schema::dropIfExists('drivers');
    }
}
