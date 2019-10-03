<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorInsuranceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_insurance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('doctor_id')->nullable();
            $table->integer('insurance_type_id')->nullable();
            $table->timestamp('start_date', true)->nullable();
            $table->timestamp('end_date', true)->nullable();
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
        Schema::dropIfExists('doctor_insurance');
    }
}
