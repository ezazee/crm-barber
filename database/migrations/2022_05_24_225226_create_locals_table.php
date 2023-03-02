<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locals', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('about')->nullable();
            $table->text('address')->nullable();
            $table->bigInteger('province_id')->unsigned()->nullable();
            $table->bigInteger('regency_id')->unsigned()->nullable();
            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->point('coordinate_point')->nullable();
            $table->string('coordinate_location')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();


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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locals');
    }
}
