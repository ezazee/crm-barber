<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDriverLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('driver_locations', function (Blueprint $table) {
            $table->bigInteger('ridehail_id')->unsigned()->nullable()->after('driver_order_id');
            $table->foreign('ridehail_id')
                ->references('id')
                ->on('ridehails')
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
        Schema::table('driver_locations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('ridehail_id');
        });
    }
}
