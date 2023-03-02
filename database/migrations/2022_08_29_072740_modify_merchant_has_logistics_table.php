<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMerchantHasLogisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_has_logistics', function (Blueprint $table) {
            $table->bigInteger('local_has_logistic_id')->after('merchant_id')->unsigned()->nullable();
            $table->foreign('local_has_logistic_id')
                ->references('id')
                ->on('local_has_logistics')
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
        Schema::table('merchant_has_logistics', function (Blueprint $table) {
            $table->dropConstrainedForeignId('local_has_logistic_id');
        });
    }
}
