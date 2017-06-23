<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOaUser extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('oa_user', function(Blueprint $table){
            $table->increments('id')->comment('主键');
            $table->string('DeptID')->nullable();
            $table->string('EName')->nullable();
            $table->string('SSN')->nullable();
            $table->integer('PIN');
            $table->string('Title')->nullable();
            $table->string('Mobile')->nullable();
            $table->string('Gender')->nullable();
            $table->string('National')->nullable();
            $table->string('email')->nullable();
            $table->string('MVerifyPass')->nullable();
            $table->string('Birthday')->nullable();
            $table->string('Tele')->nullable();
            $table->string('Card')->nullable();
            $table->string('Address')->nullable();
            $table->string('Annualleave')->nullable();
            $table->string('FPHONE')->nullable();
            $table->string('PostCode')->nullable();
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
        Schema::drop('oa_user');
    }
}
