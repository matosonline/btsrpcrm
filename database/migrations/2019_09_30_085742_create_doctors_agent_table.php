<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDoctorsAgentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('doctors_agent', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('doctor_id');
			$table->integer('agent_id');
			$table->integer('create_by')->nullable();
			$table->timestamps();
			$table->integer('update_by')->nullable();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('doctors_agent');
	}

}
