<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVendorFieldToPaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->string('payment_gateway_vendor')->after('order')->nullable();
            $table->enum('fee_additional_type', ['Fixed', 'Percent'])->after('fee_additional')->nullable();

            $table->dropUnique('payment_methods_name_unique');
            $table->dropUnique('payment_methods_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->dropColumn('payment_gateway_vendor');
            $table->dropColumn('fee_additional_type');

            // $table->unique('name', 'payment_methods_name_unique');
            // $table->unique('code', 'payment_methods_code_unique');
        });
    }
}
