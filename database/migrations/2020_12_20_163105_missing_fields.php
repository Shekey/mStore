<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MissingFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->bigInteger('marketId');
        });


        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('isOrdered')->default(false);
            $table->boolean('isRead')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->dropColumn('marketId');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('isOrdered');
            $table->dropColumn('isRead');
        });
    }
}
