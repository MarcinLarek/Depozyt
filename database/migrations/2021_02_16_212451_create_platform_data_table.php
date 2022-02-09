<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatformDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platform_data', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('street');
            $table->string('city');
            $table->string('email');
            $table->string('nip');
            $table->string('regon');
            $table->string('krs');
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
        Schema::dropIfExists('platform_data');
    }
}
