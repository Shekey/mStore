<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUsersTabe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->renameColumn('isAdmin', 'isActive');
            $table->string('idFront',100)->nullable()->change();
            $table->string('idBack',100)->nullable()->change();
            $table->string('address',100)->nullable()->change();
            $table->string('phone',50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->renameColumn('isActive', 'isAdmin');
            $table->string('idFront',80)->nullable(false)->change();
            $table->string('idBack',80)->nullable(false)->change();
            $table->string('address',100)->nullable(false)->change();
            $table->string('phone',50)->nullable(false)->change();
        });
    }
}
