<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionToAccept extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'contractor_id',
        'customer_accept',
        'contractor_accept',
        'bank_name',
        'currency_id',
        'name',
        'transaction_code',
        'commission_payer',
        'from_date',
        'to_date',
        'amount',
        'date_of_order',
        'payment',
        'status',
        'token',
        'transaction_type',
        'description'
    ];
}
