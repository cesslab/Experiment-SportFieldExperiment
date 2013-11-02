<?php

use Illuminate\Database\Migrations\Migration;

use SportExperiment\Framework\Repository\Eloquent\User as UserModel;
class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table){
			$table->increments(UserModel::$ID_KEY);
			$table->string(UserModel::$USER_NAME_KEY)->unique();
			$table->string(UserModel::$PASSWORD_KEY);
            $table->integer('role')->unsigned();
			$table->boolean('active')->default(false);
            $table->timestamps();
            $table->engine= 'InnoDB';
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