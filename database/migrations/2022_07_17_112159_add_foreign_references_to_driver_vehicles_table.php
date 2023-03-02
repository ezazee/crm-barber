<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignReferencesToDriverVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('driver_vehicles', function (Blueprint $table) {
            $table->foreign('driver_id')
                ->references('id')
                ->on('drivers')
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
        Schema::table('driver_vehicles', function (Blueprint $table) {
            $table->dropForeign('driver_vehicles_driver_id_foreign');
            $table->dropIndex('driver_vehicles_driver_id_foreign');
        });
    }
}
