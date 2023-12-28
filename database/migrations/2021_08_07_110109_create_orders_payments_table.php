<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_payments', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('date');
            $table->string('total');
            $table->string('Mode_of_payment');
            $table->string('pay');
            $table->string('due');
            $table->string('Payment_type');
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
        Schema::dropIfExists('orders_payments');
    }
}
