<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVoiceActorOwnershipTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('voice_actor_ownership', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('UserName', 32)->default('');
			$table->string('Content')->default('');
			$table->string('ClaimOwnership')->default('');
			$table->string('Guild', 255);
			$table->timestamp('create_at')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('voice_actor_ownership');
	}

}
