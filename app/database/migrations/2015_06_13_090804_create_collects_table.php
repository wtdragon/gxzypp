<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('collects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('userid');
			$table->integer('collegeid');
			$table->integer('careerid');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('collects');
	}

}
