<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exam', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->double('final_score', 4, 2);
			$table->dateTime('start_at');
			$table->dateTime('stop_at');
			$table->enum('finish', array('N', 'Y'));
			$table->dateTime('finish_at');
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
		Schema::drop('exam');
	}

}
