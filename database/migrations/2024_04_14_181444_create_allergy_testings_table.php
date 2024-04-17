<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllergyTestingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allergy_testings', function (Blueprint $table) {
            $table->id();
            $table->string("allergy_id")->nullable();
            $table->string("allergy_desc")->nullable();
            $table->string("price")->nullable();
            $table->string("status")->default(0);
            $table->string("syn_flag")->default(0);
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
        Schema::dropIfExists('allergy_testings');
    }
}
