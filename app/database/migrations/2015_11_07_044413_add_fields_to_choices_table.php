<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFieldsToChoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('choices', function(Blueprint $table)
		{
			$table->text('description')->after('id');
			$table->enum('correct_choice', array('N', 'Y'))->after('description');
			$table->decimal('correct_mark', 2, 2)->after('correct_choice');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('choices', function(Blueprint $table)
		{
			$table->dropColumn('description');
			$table->dropColumn('correct_choice');
			$table->dropColumn('correct_mark');
		});
	}

}
