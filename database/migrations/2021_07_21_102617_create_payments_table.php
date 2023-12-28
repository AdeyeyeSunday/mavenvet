<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('Pet_id');
            $table->string('Services');
            $table->string('Payment_Status');
            $table->string('Amount_Paid');
            $table->string('Outstanding_Payment')->nullable();
            $table->string('Mode_Of_Payment');
            $table->string('Total_bill');
            $table->string('Veterinarian');
            $table->string('Card_Payment');
            $table->string('Vaccine')->nullable();
            $table->string('date');
            $table->string('month');
            $table->string('year');
            $table->string('user_id');
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
        Schema::dropIfExists('payments');
    }
}
