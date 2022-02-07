<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'email', 'account_number', 'nip', 'country_id', 'phone', 'post_code', 'street', 'city', 'active'
    ];

    public function getAccountNumber()
    {
        return $this->getAttribute('account_number');
    }

    public function getCity()
    {
        return $this->getAttribute('city');
    }

    public function getStreet()
    {
        return $this->getAttribute('street');
    }

    public function getPostCode()
    {
        return $this->getAttribute('post_code');
    }

    public function isActive()
    {
        return $this->getAttribute('active');
    }

    public function getId()
    {
        return $this->getAttribute('id');
    }
}
