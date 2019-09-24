<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('fName');
            $table->string('lName');
            $table->string('inputAddress');
            $table->string('inputAddress2')->nullable();
            $table->string('inputCity');
            $table->integer('inputState');
            $table->string('inputZip')->nullable();
            $table->string('email');
            $table->string('phone1');
            $table->date('dob');
            $table->boolean('agreeOrDisagree');
            $table->integer('planType')->nullable();
            $table->string('pcpName')->nullable();
            $table->longText('notes')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
