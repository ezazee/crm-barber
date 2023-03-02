<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalTableToLocalPromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('local_promotions', function (Blueprint $table) {
            $table->bigInteger('local_id')->after('id')->unsigned();
            $table->uuid('uuid')->after('id');

            $table->foreign('local_id')
                ->references('id')
                ->on('locals')
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
        Schema::table('local_promotions', function (Blueprint $table) {
            $table->dropColumn(['uuid']);
            $table->dropConstrainedForeignId('local_id');
        });
    }
}
