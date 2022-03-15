<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_name',
        'currency_id',
        'amount',
        'generated_document_id',

        'Kod_zlecenia',
        'Data_wykonania',
        'kwota',
        'Nr_rozliczeniowy_banku_zleceniodawcy',
        'Pole_zerowe1',
        'Nr_rachunku_banku_zleceniodawcy',
        'Nr_rachunku_banku_kontrahenta',
        'Nazwa_i_adres_zleceniodawcy',
        'Nazwa_i_adres_kontrahenta',
        'Pole_zerowe2',
        'Nr_rozliczeniowy_banku_kontrahenta',
        'Tytul_zlecenia',
        'Pole_puste1',
        'Pole_puste2',
        'Klasyfikacja_polecenia',

    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function document()
    {
        return $this->belongsTo(GeneratedDocument::class, 'generated_document_id');
    }

    public function getDocumentPath()
    {
        $document = $this->document()->first();
        $documentPath = '';
        if ($document !== null) {
            $documentPath = $document->getFileName();
        }

        return $documentPath;
    }
}
