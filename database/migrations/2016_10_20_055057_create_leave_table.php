<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('leave', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('empid')->unique();
            $table->string('name')->nullable();
            $table->string('username')->unique();
            $table->string('totalleave')->nullable();
            $table->string('dates')->nullable();


            $table->rememberToken();
            $table->timestamps();
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
        Schema::drop('leave');

    }

}
