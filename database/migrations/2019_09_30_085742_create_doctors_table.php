<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDoctorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('doctors', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('location_nm', 250)->nullable();
			$table->text('address1')->nullable();
			$table->bigInteger('npi')->nullable();
			$table->string('last_name', 50)->nullable();
			$table->string('first_name', 50)->nullable();
			$table->string('type', 50)->nullable();
			$table->text('primary_speciality', 65535)->nullable();
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
		Schema::drop('doctors');
	}

}
