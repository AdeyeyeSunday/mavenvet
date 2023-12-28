<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewVaccinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_vaccines', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('Name');
            $table->string('Cost');
            $table->string('Price');
            $table->string('Quantity');
            $table->string('minimum');
            $table->string('Image');
            $table->string('expiry_date');
            $table->string('new_supply');
            $table->string('supply_date');
            $table->string('brand');
            $table->string('supplier')->nullable();
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
        Schema::dropIfExists('new_vaccines');
    }
}
