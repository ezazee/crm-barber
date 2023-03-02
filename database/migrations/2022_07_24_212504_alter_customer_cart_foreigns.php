<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterCustomerCartForeigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::beginTransaction();
        Schema::table('customer_carts', function (Blueprint $table) {
            $table->dropForeign('customer_carts_merchant_id_foreign');
            $table->dropForeign('customer_carts_customer_id_foreign');
        });
        Schema::table('customer_carts', function (Blueprint $table) {
            $table->foreign('merchant_id')
                ->references('id')
                ->on('merchants')
                ->onDelete('cascade');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
        });
        DB::commit();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::beginTransaction();
        Schema::table('customer_carts', function (Blueprint $table) {
            $table->dropForeign('customer_carts_merchant_id_foreign');
            $table->dropForeign('customer_carts_customer_id_foreign');
        });
        Schema::table('customer_carts', function (Blueprint $table) {
            $table->foreign('merchant_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('customer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        DB::commit();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
