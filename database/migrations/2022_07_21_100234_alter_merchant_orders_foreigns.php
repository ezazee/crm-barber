<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterMerchantOrdersForeigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::beginTransaction();
        Schema::table('merchant_orders', function (Blueprint $table) {
            $table->dropForeign('merchant_orders_merchant_id_foreign');
            $table->dropForeign('merchant_orders_customer_id_foreign');
        });
        Schema::table('merchant_orders', function (Blueprint $table) {
            $table->foreign('merchant_id')
                ->references('id')
                ->on('merchants')
                ->onDelete('cascade');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
        });
        // DB::commit();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::beginTransaction();
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('merchant_orders', function (Blueprint $table) {
            $table->dropForeign('merchant_orders_merchant_id_foreign');
            $table->dropForeign('merchant_orders_customer_id_foreign');
        });
        Schema::table('merchant_orders', function (Blueprint $table) {
            $table->foreign('merchant_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('customer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::commit();
    }
}
