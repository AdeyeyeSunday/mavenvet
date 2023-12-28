<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_carts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('items_name')->nullable();
            $table->string('qty')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('vaccine_id')->nullable();
            $table->string('service')->nullable();
            $table->string('Quantity')->nullable();
            $table->string('Amount')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('service_id')->nullable();
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
        Schema::dropIfExists('service_carts');
    }
}
