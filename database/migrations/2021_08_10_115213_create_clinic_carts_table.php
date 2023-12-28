<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_carts', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('items_name');
            $table->string('qty');
            $table->string('Quantity')->nullable();
            $table->string('selling_price');
            $table->string('vaccine_id');
            $table->string('syn_flag')->default(0);
            // $table->string('');
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
        Schema::dropIfExists('clinic_carts');
    }
}
