<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnMarketIdTableArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function(Blueprint $table) {
            $table->renameColumn('marketId', 'market_id');
            $table->renameColumn('categoryId', 'category_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function(Blueprint $table) {
            $table->renameColumn('market_id', 'marketId');
            $table->renameColumn('category_id', 'categoryId');
        });
    }
}
