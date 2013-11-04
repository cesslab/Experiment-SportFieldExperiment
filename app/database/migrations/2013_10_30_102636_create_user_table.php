<?php

use Illuminate\Database\Migrations\Migration;
use SportExperiment\Repository\Eloquent\User;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(User::$TABLE_KEY, function($table){
			$table->increments(User::$ID_KEY);
			$table->string(User::$USER_NAME_KEY)->unique();
			$table->string(User::$PASSWORD_KEY);
            $table->integer(User::$ROLE_KEY)->unsigned();
			$table->boolean(User::$ACTIVE_KEY)->default(false);
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
		Schema::drop(User::$TABLE_KEY);
	}

}