<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccineordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccineorders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('name');
            $table->string('discount');
            $table->string('phone');
            $table->string('address');
            $table->string('order_status');
            $table->string('Mode_of_payment');
            $table->string('cash_transfer')->nullable();
            $table->string('cash_pos')->nullable();
            $table->string('location')->nullable();
            $table->string('pay');
            $table->string('due');
            $table->string('total');
            $table->string('Payment_type');
            $table->string('date');
            $table->string('month');
            $table->string('year');
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
        Schema::dropIfExists('vaccineorders');
    }
}
