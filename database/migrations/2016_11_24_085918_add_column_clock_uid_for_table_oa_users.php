<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnClockUidForTableOaUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('oa_users', function(Blueprint $table){
            $table->integer('clock_uid')->comment('打卡用户id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('oa_users', function(Blueprint $table){
            $table->dropColumn('clock_uid');
        });
    }
}
