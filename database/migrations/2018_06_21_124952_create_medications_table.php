<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('medicine_id')->nullable();
            $table->integer('formula_id')->nullable();
            $table->integer('formula_id')->nullable();
            $table->string('dosage')->nullable();
            $table->string('notes')->nullable();
            $table->string('temperature')->nullable();
            $table->string('weight')->nullable();
            $table->string('value')->nullable();
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
        Schema::dropIfExists('medications');
    }
}
