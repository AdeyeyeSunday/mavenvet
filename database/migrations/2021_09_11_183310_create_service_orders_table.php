<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('Pet_name')->nullable();
            $table->string('Unregister')->nullable();
            $table->string('Owner_name')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Next_vaccination_appointment')->nullable();
            $table->string('Next_appointments')->nullable();
            $table->string('total_price');
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
            $table->string('new_payment_user_id');
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
        Schema::dropIfExists('service_orders');
    }
}
