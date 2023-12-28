<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->OnDelete('cascade');
            $table->string('Title');
            $table->string('name_id');
            $table->string('email');
            $table->string('number');
            $table->string('gst_number');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('image');
            $table->string('gender');
            $table->string('position');
            $table->string('staff_no');
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
        Schema::dropIfExists('employees');
    }
}
