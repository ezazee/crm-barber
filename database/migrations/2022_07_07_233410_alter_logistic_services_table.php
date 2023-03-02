<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLogisticServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Logistic
        Schema::table('logistics', function (Blueprint $table) {
            $table->boolean('is_active')->after('source')->default(true);
        });

        // Logistic Service
        Schema::table('logistic_services', function (Blueprint $table) {
            $table->dropColumn(['estimation']);
            $table->bigInteger('logistic_id')->after('description')->unsigned()->nullable();
            $table->boolean('is_active')->after('description')->default(true);

            $table->foreign('logistic_id')
                ->references('id')
                ->on('logistics')
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
        // Logistic
        Schema::table('logistics', function (Blueprint $table) {
            $table->dropColumn(['is_active']);
        });
        // Logistic Service
        Schema::table('logistic_services', function (Blueprint $table) {
            $table->string('estimation')->after('type')->nullable();
            $table->dropConstrainedForeignId('logistic_id');
            $table->dropColumn(['is_active']);
        });
    }
}
