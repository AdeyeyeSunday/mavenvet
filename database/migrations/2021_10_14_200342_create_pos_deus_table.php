<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosDeusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_deus', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('total_price')->nullable();;
            $table->string('Mode_of_payment')->nullable();
            $table->string('pay')->nullable();
            $table->string('due')->nullable();
            $table->string('location')->nullable();
            $table->string('Payment_type')->nullable();
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
        Schema::dropIfExists('pos_deus');
    }
}
