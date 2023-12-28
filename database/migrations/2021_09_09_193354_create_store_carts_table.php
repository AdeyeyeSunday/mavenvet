<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_carts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('Name');
            $table->string('Quantity');
            $table->string('Price');
            $table->string('prod_id');
            $table->string('status')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('date');
            $table->string('month');
            $table->string('year');
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
        Schema::dropIfExists('store_carts');
    }
}
