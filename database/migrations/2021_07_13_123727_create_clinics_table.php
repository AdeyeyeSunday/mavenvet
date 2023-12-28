<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('pic');
            $table->string('Pet_name');
            $table->string('Breed');
            $table->string('Gender');
            $table->string('Name_Of_Pet_Owner');
            $table->string('Owner_Phone_Number');
            $table->string('Pet_Card_Number');
            $table->string('Color');
            $table->string('Age');
            $table->string('Veterinarian');
            $table->string('date');
            $table->string('month');
            $table->string('year');
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
        Schema::dropIfExists('clinics');
    }
}
