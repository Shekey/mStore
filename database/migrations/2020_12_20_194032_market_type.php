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
        Schema::create('marketType', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
        });

        Schema::table('articles', function (Blueprint $table) {
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
        Schema::dropIfExists('marketType');
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign('marketType');
            $table->dropColumn('marketType');

        });

    }
}
