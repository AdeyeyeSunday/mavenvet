<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_items', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('order_id')->nullable();
            $table->string('prod_name')->nullable();
            $table->string('pro_id')->nullable();
            $table->string('qty')->nullable();
            $table->string('price')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('service')->nullable();
            $table->string('service_id')->nullable();
            $table->string('Amount')->nullable();
            $table->string('date')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
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
        Schema::dropIfExists('service_items');
    }
}
