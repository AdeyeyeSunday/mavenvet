<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->string('pet_id');
            // $table->string('user_id');
            $table->string('diagnosis');
            $table->string('amount');
            $table->string('date');
            $table->string('payment')->nullable();
            $table->string('mode')->nullable();
            $table->string('user_id')->nullable();
            $table->string('location')->nullable();
            $table->string('month');
            $table->string('year');
            $table->string('staus');
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
        Schema::dropIfExists('admissions');
    }
}
