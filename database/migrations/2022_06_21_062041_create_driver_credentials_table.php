<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_credentials', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('driver_id')->unsigned();
            $table->string('type'); // KTP
            $table->string('label'); // Kartu Tanda Penduduk
            $table->string('credential_name');
            $table->string('credential_number');
            $table->string('file');
            $table->string('file_link');
            $table->string('status'); // Pending, Verified, Rejected, etc
            $table->text('status_note')->nullable();
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('driver_id')
                ->references('id')
                ->on('drivers')
                ->onDelete('cascade');
            $table->foreign('admin_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('driver_credentials');
    }
}
