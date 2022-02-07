<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatformExceptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platform_exceptions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->string('controller');
            $table->string('method');
            $table->text('message');
            $table->unsignedBigInteger('user_id')->nullable()->references('id')->on('users');
            $table->ipAddress('client_ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('platform_exceptions');
    }
}
