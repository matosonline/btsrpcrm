<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDoctorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function($table)
        {
            $table->date('dob')->nullable()->after('primary_speciality');
            $table->string('ssn',250)->nullable()->after('dob');
            $table->string('lang',250)->nullable()->after('ssn');
            $table->string('inputAddress2',250)->nullable()->after('lang');
            $table->string('inputCity',250)->nullable()->after('inputAddress2');
            $table->integer('inputState')->nullable()->after('inputCity');
            $table->string('inputZip',250)->nullable()->after('inputState');
            $table->string('email',250)->nullable()->after('inputZip');
            $table->string('phone1',250)->nullable()->after('email');
            $table->text('notes')->nullable()->after('phone1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn('planTypeDetail');
        });
    }
}
