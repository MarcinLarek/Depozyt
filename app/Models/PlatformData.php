<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformData extends Model
{
    use HasFactory;
    protected $fillable = [
        'company', 'email', 'krs', 'regon', 'nip', 'street', 'city'
    ];
}
