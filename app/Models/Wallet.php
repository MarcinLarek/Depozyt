<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount', 'user_id', 'currency_id'
        ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
