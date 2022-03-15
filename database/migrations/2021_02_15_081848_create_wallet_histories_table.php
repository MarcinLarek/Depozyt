<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_histories', function (Blueprint $table) {
            $table->id();

            $table->integer('Kod_zlecenia')->default(110);
            $table->integer('Data_wykonania')->default(0);
            $table->unsignedBigInteger('kwota')->default(0);
            $table->integer('Nr_rozliczeniowy_banku_zleceniodawcy')->default(0);
            $table->integer('Pole_zerowe1')->default(0);
            $table->string('Nr_rachunku_banku_zleceniodawcy')->default(0);
            $table->string('Nr_rachunku_banku_kontrahenta')->default(0);
            $table->string('Nazwa_i_adres_zleceniodawcy')->default("||");
            $table->string('Nazwa_i_adres_kontrahenta')->default("||");
            $table->integer('Pole_zerowe2')->default(0);
            $table->integer('Nr_rozliczeniowy_banku_kontrahenta')->default(0);
            $table->string('Tytul_zlecenia')->default("|||");
            $table->string('Pole_puste1')->nullable()->default(null);
            $table->string('Pole_puste2')->nullable()->default(null);
            $table->integer('Klasyfikacja_polecenia')->default(51);

            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('bank_name')->default(0);
            $table->unsignedBigInteger('currency_id')->default(0);
            $table->double('amount')->default(0);
            $table->unsignedBigInteger('generated_document_id')->default(0);
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
        Schema::dropIfExists('wallet_histories');
    }
}
