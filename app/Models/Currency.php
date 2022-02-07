<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'symbol', 'name', 'active'
    ];

    public static function getActiveCurrency()
    {
        return self::where('active', 1)->get();
    }

    public function getName()
    {
        return $this->getAttribute('name');
    }

    public function getSymbol()
    {
        return $this->getAttribute('symbol');
    }
}
