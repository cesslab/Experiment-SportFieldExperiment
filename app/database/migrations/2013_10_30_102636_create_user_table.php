<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use SportExperiment\Model\Eloquent\User;

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
			$table->string(User::$USER_NAME_KEY);
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