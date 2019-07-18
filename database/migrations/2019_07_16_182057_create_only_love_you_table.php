<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOnlyLoveYouTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('only_love_you', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('UserName')->default('');
			$table->string('Content', 128)->default(' ');
			$table->string('Love', 128)->default(' ');
			$table->date('create_at');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('only_love_you');
	}

}
