<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('fname');
            $table->string('phone');
            $table->string('address')->nullable();;
            $table->string('total_price')->nullable();;
            $table->string('discount')->nullable();
            $table->string('trackking_id');
            $table->string('order_status');
            $table->string('Mode_of_payment')->nullable();
            $table->string('pay')->nullable();
            $table->string('due')->nullable();
            $table->string('Payment_type')->nullable();
            $table->string('cash_transfer')->nullable();
            $table->string('cash_pos')->nullable();
            $table->string('location')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
