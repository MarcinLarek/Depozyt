<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientBankAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'name', 'bank_name', 'currency_id', 'country_id', 'account_number', 'swift'
    ];

    public function getName()
    {
        return $this->getAttribute('name');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function getCurrencyName()
    {
        return $this->currency->first()->name;
    }

    public function getBankName()
    {
        return $this->getAttribute('bank_name');
    }

    public function getAccountNumber()
    {
        return $this->getAttribute('account_number');
    }

    public function getSwift()
    {
        return $this->getAttribute('swift');
    }
    public function isActive(): bool
    {
        return $this->getAttribute('active');
    }

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
