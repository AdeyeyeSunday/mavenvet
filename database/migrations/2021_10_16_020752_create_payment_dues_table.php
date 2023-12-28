<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_dues', function (Blueprint $table) {
            $table->id();
            // $table->string('Pet_name')->nullable();
            $table->string('Owner_name')->nullable();
            $table->string('total_price')->nullable();
            $table->string('Mode_of_payment')->nullable();
            $table->string('pay')->nullable();
            $table->string('due')->nullable();
            $table->string('Payment_type')->nullable();
            $table->string('date')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
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
        Schema::dropIfExists('payment_dues');
    }
}
