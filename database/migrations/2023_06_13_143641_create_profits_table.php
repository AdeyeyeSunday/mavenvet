<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profits', function (Blueprint $table) {
            $table->id();
            $table->string("year")->nullable();
            $table->string("month")->nullable();
            $table->string("type")->nullable();
            $table->string("optional")->nullable();
            $table->string("totalSales")->nullable();
            $table->string("totalCost")->nullable();
            $table->string("totalExpense")->nullable();
            $table->string("Profit")->nullable();
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
        Schema::dropIfExists('profits');
    }
}
