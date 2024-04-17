<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOphthalmicExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ophthalmic_examinations', function (Blueprint $table) {
            $table->id();
            $table->string("ophthalmic_id")->nullable();
            $table->string("ophthalmic_desc")->nullable();
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
        Schema::dropIfExists('ophthalmic_examinations');
    }
}
