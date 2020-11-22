<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table ->string('patient_name');
            $table ->date('patient_dob');
            $table ->integer('patient_no')->unique();  
            $table ->string('patient_addres');
            $table ->integer('reference_id');
            $table ->integer('classification_id');
            $table ->integer('medical_id');
            $table ->date('date_dignised');
            $table ->integer('clinic_test_id');
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
        Schema::dropIfExists('patients');
    }
}
