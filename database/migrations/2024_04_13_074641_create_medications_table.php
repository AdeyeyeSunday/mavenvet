<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string("desc")->nullable();
            $table->string("med_category_id")->nullable();
            $table->string("dosage")->nullable();
            $table->string("unit")->nullable();
            $table->string("price")->nullable();
            $table->string("allow_edit_price")->nullable();
            $table->string("allow_edit_unit")->nullable();
            $table->string("allow_edit_dosage")->nullable();
            $table->string("qty")->nullable();
            $table->string("syn_flag")->default(0);
            $table->string("user_id")->nullable();
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
