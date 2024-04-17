<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemconfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systemconfigurations', function (Blueprint $table) {
            $table->id();
            $table->string("clinic_name");
            $table->string("clinic_token");
            $table->string("allow_doc__to_recieve_payment");
            $table->string("allow_doube_mode_of_payment");
            $table->string("disable_refer");
            $table->string("update_case_note_time");
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
        Schema::dropIfExists('systemconfigurations');
    }
}
