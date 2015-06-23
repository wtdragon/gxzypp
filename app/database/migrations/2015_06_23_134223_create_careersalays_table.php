<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareersalaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('careersalays', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('chengshi');
			$table->string('zhuanye');
			$table->text('srsptu');
			$table->text('gzjygztj');
			$table->text('lngzbh');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('careersalays');
	}

}
