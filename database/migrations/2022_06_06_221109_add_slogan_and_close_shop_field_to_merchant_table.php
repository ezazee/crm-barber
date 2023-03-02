<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSloganAndCloseShopFieldToMerchantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->string('slogan')->nullable();
            $table->boolean('is_closed')->default(false);
            $table->timestamp('close_start')->nullable();
            $table->timestamp('close_end')->nullable();
            $table->string('close_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchants', function (Blueprint $table) {
            $table->dropColumn([
                'slogan',
                'is_closed',
                'close_start',
                'close_end',
                'close_note',
            ]);
        });
    }
}
