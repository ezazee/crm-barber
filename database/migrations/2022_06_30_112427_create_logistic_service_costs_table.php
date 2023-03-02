<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogisticServiceCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistic_service_costs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->bigInteger('logistic_service_id')->unsigned()->nullable();
            $table->enum('cost_type', ['By Distance', 'By Region']);
            $table->double('cost_amount');
            $table->float('cost_for_distance')->nullable(); // in kilometer
            $table->bigInteger('province_id')->unsigned()->nullable();
            $table->bigInteger('regency_id')->unsigned()->nullable();
            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('logistic_service_id')
                ->references('id')
                ->on('logistic_services')
                ->onDelete('cascade');
            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->onDelete('cascade');
            $table->foreign('regency_id')
                ->references('id')
                ->on('regencies')
                ->onDelete('cascade');
            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
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
        Schema::dropIfExists('logistic_service_costs');
    }
}
