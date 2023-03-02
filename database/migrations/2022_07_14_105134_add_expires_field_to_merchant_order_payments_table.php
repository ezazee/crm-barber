<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExpiresFieldToMerchantOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_order_payments', function (Blueprint $table) {
            $table->timestamp('expired_at')->nullable()->after('image_file_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchant_order_payments', function (Blueprint $table) {
            $table->dropColumn([
                'expired_at'
            ]);
        });
    }
}
