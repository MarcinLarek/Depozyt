<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformBankAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'bank_name', 'currency_id', 'account_number', 'active'
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function isActive()
    {
        return $this->getAttribute('active') == 1 ? true : false;
    }
}
