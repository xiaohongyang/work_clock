<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UniqueFiledPINAndFieldClockUid extends Migration
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
            $table->unique('PIN');
            $table->unique('clock_uid');
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
            $table->dropUnique('PIN');
            $table->dropUnique('clock_uid');
        });
    }
}
