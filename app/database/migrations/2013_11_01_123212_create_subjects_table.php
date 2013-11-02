<?php

use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('subjects', function($table){
            $table->increments('id');
            $table->integer('session_id')->unsigned();
            $table->string('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profession');
            $table->string('education');
            $table->string('gender');
            $table->integer('age')->unsigned();
            $table->string('ethnicity');
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
        Schema::drop('subjects');
	}

}