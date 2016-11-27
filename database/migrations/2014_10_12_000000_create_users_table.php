<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id')->unique();
			$table->string('name')->default(' ')->nullable();
            $table->string('designation')->default(' ')->nullable();
            $table->string('duty')->default(' ')->nullable();
            $table->string('email')->default(' ')->nullable();
            $table->string('note')->default(' ')->nullable();
            $table->string('image')->nullable();

            $table->string('level')->default('0');

            $table->string('username')->unique();
			$table->string('password', 60);
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
		Schema::drop('users');
	}

}
