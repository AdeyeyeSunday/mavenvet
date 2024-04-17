<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medication_requests', function (Blueprint $table) {
            $table->id();
            $table->string("user_id")->nullable();
            $table->string("request_medication_token")->nullable();
            $table->string("pet_id")->nullable();
            $table->string("med_category")->nullable();
            $table->string("medication")->nullable();
            $table->string("price")->nullable();
            $table->string("qty")->nullable();
            $table->string("dosage")->nullable();
            $table->string("unit")->nullable();
            $table->string("amount_paid")->nullable();
            $table->string("payment_status")->nullable();
            $table->string("date")->nullable();
            $table->string("month")->nullable();
            $table->string("year")->nullable();
            $table->string("syn_flag")->default(0);
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
        Schema::dropIfExists('medication_requests');
    }
}
