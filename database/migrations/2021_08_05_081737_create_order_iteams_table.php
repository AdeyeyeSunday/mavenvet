<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderIteamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_iteams', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('order_id');
            $table->string('prod_id');
            $table->string('qty');
            $table->string('price');
            $table->string('product_id');
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
        Schema::dropIfExists('order_iteams');
    }
}
