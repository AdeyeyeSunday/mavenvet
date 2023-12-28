<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newproducts', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Cost');
            $table->string('Price');
            $table->string('Quantity');
            $table->string('new_supply');
            $table->string('expiry_date')->nullable();
            $table->string('Quantity_level')->nullable();
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->string('month');
            $table->string('year');
            $table->string('new_date')->nullable();
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
        Schema::dropIfExists('newproducts');
    }
}
