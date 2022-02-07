<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'generated_document_id',
        'user_id',
        'bank_name',
        'currency_id',
        'amount',
        'generated_document_id'
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
