<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDriverVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('driver_vehicles', function (Blueprint $table) {
            $table->boolean('in_use')->default(false)->after('registration_file_link');
            $table->text('status_note')->nullable()->after('registration_file_link');
            $table->tinyInteger('status')->default(0)->after('registration_file_link'); // 0: In Review, 1: Approved, 3: Rejected, etc
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
            $table->dropColumn([
                'in_use',
                'status',
                'status_note'
            ]);
        });
    }
}
