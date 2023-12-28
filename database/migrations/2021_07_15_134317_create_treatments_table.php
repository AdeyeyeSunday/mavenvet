<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('Pet_id');
            $table->string('pro_id');
            $table->string('Diagnosis_Test');
            $table->string('Next_Vaccination_Appointment');
            $table->string('Next_Appointments');
            $table->string('Veterinarian');
            $table->text('date');
            $table->text('month');
            $table->text('year');
            $table->string('syn_flag')->default(0);
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
        Schema::dropIfExists('treatments');
    }
}
