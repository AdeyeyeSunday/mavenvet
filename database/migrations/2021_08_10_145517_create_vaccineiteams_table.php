<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccineiteamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccineiteams', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('items_name');
            $table->string('vaccine_id');
            $table->string('qty');
            $table->string('price');
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
        Schema::dropIfExists('vaccineiteams');
    }
}
