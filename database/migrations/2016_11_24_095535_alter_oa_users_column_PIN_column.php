<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use \Illuminate\Support\Facades\DB;

class AlterOaUsersColumnPINColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement(' ALTER TABLE  oa_users MODIFY COLUMN PIN varchar(50) not null default \'\'');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement(' ALTER TABLE  oa_users MODIFY COLUMN PIN int(11) not null default 0 ');
    }
}
