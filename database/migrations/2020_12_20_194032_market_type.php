<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MarketType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markettype', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
        });

        Schema::table('markets', function (Blueprint $table) {
            $table->unsignedBigInteger('marketType')->nullable();
            $table->foreign('marketType')->references('id')->on('marketType')->onDelete('cascade');
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
            $table->dropForeign('marketType');
            $table->dropColumn('marketType');
        });
        Schema::dropIfExists('marketType');
    }
}
