<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegistrationCompleteFieldToDriversTableRev extends Migration
{
    // public function __construct()
    // {
    //     \Illuminate\Support\Facades\DB::getDoctrineSchemaManager()
    //    ->getDatabasePlatform()->registerDoctrineTypeMapping('boolean', 'tinyint');
    // }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn(['registration_complete']);
        });
        Schema::table('drivers', function (Blueprint $table) {
            $table->boolean('registration_complete')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn(['registration_complete']);
        });
        Schema::table('drivers', function (Blueprint $table) {
            $table->string('registration_complete')->nullable();
        });
    }
}
