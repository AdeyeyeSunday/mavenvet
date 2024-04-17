<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_images', function (Blueprint $table) {
            $table->id();
            $table->string("user_id")->nullable();
            $table->string("pet_id")->nullable();
            $table->string("image_token")->nullable();
            $table->string("name")->nullable();
            $table->string("file")->nullable();
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
        Schema::dropIfExists('request_images');
    }
}
