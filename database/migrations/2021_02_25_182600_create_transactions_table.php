<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('contractor_id');
            $table->string('bank_name');
            $table->foreignId('currency_id')->references('id')->on('countries');
            $table->string('name');
            $table->string('transaction_code')->unique();
            $table->string('commission_payer');
            $table->date('from_date');
            $table->date('to_date');
            $table->double('amount');
            $table->date('date_of_order');
            $table->double('payment');
            $table->string('status');
            $table->string('token')->unique();
            $table->integer('transaction_type');
            $table->text('description');
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
        Schema::dropIfExists('transactions');
    }
}
