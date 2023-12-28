<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            // $table->string('fname');
            $table->string('date');
            $table->string('month');
            $table->string('year');
            // $table->string('status');
            $table->string('Quantity');
            $table->string('Price');
            $table->string('subtotal');
            $table->string('total_price');
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
        Schema::dropIfExists('shop_orders');
    }
}
