<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_name', 'country_code'
    ];

    public function getId()
    {
        return $this->getAttribute('id');
    }

    public function getCountryName()
    {
        return $this->getAttribute('country_name');
    }

    public function getCountryCode()
    {
        return $this->getAttribute('country_code');
    }
}
