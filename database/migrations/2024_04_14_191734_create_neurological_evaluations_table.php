<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeurologicalEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neurological_evaluations', function (Blueprint $table) {
            $table->id();
            $table->string("neurological_id")->nullable();
            $table->string("neurological_desc")->nullable();
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
        Schema::dropIfExists('neurological_evaluations');
    }
}
