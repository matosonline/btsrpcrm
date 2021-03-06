<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCentersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('centers', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('centerName');
			$table->string('inputAddress');
			$table->string('inputAddress2');
			$table->string('inputCity');
			$table->integer('inputState');
			$table->string('inputZip');
			$table->string('phone1');
			$table->string('fax1');
			$table->timestamps();
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
		Schema::drop('centers');
	}

}
