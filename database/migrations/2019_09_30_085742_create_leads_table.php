<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leads', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->text('fName', 65535)->nullable();
			$table->string('lName')->nullable();
			$table->string('inputAddress')->nullable();
			$table->string('inputAddress2')->nullable();
			$table->string('inputCity')->nullable();
			$table->integer('inputState')->nullable();
			$table->string('inputZip')->nullable();
			$table->string('email')->nullable();
			$table->string('phone1')->nullable();
			$table->date('dob')->nullable();
			$table->integer('lang')->nullable();
			$table->boolean('agreeOrDisagree')->nullable();
			$table->integer('planType')->nullable();
			$table->string('planTypeDetail');
			$table->string('pcpName')->nullable();
			$table->integer('agent')->nullable();
			$table->text('notes')->nullable();
			$table->string('careID')->nullable();
			$table->integer('healthPlan')->nullable();
			$table->date('startDate')->nullable();
			$table->integer('lStatus')->nullable()->default(2)->comment('1=>new,2=>pending,3=>close,4=>lost');
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
		Schema::drop('leads');
	}

}
