<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasenotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casenotes', function (Blueprint $table) {
            $table->id();
            $table->string('case_id');
            $table->text('visual_evaluation');
            $table->text('physical_examination');
            $table->text('other_examination');
            $table->text('result');
            $table->text('diagnosis');
            $table->text('treatment');
            $table->string('temp');
            $table->text('pulse');
            $table->text('resp');
            $table->string('Veterinarian');
            $table->string('Status');
            $table->string('date');
            $table->string('month');
            $table->string('year');
            $table->string('user_id');
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
        Schema::dropIfExists('casenotes');
    }
}
