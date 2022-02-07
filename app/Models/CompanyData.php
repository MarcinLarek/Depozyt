<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyData extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'nip', 'regon', 'krs', 'email', 'phone_number', 'street', 'post_code', 'city'
    ];
}
