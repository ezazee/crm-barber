<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_admins', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('local_id')->unsigned()->nullable();
            $table->string('phone')->nullable();
            $table->string('type')->nullable(); // Eg: PIC Admin, General Admin, etc
            $table->string('avatar')->nullable();
            $table->string('avatar_link')->nullable();
            $table->string('avatar_thumb')->nullable();
            $table->string('avatar_thumb_link')->nullable();
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_admins');
    }
}
