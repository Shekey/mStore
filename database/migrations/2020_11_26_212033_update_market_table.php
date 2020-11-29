<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMarketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('markets', function (Blueprint $table) {
            $table->decimal('payPerOrder')->nullable();
            $table->decimal('orderPaid')->default(0);
            $table->time('startTime');
            $table->time('endTime');
            $table->time('startTimeSunday');
            $table->time('endTimeSunday');
            $table->boolean('isClosed')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('markets', function (Blueprint $table) {
            $table->dropColumn('payPerOrder');
            $table->dropColumn('orderPaid');
            $table->dropColumn('startTime');
            $table->dropColumn('endTime');
            $table->dropColumn('startTimeSunday');
            $table->dropColumn('endTimeSunday');
            $table->dropColumn('isClosed');
        });
    }
}
