<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMidwiferiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_midwiferies', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Category');
            $table->string('Cost');
            $table->string('Price');
            $table->string('Quantity');
            $table->string('supplier')->nullable();
            $table->string('Quantity_level');
            $table->string('new_supply')->nullable();
            $table->string('location')->nullable();
            $table->string('Description')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('new_date')->nullable();
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
        Schema::dropIfExists('product_midwiferies');
    }
}
