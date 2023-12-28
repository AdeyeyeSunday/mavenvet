<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_items', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('prod_name');
            $table->string('pro_id');
            $table->string('qty');
            $table->string('price');
            $table->string('status');
            $table->string('subtotal');
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
        Schema::dropIfExists('shop_items');
    }
}
