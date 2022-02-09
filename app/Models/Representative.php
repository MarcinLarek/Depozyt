<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'surname',
        'name',
        'pesel',
        'document_type',
        'document_number',
        'email',
        'phone',
        'city',
        'post_code',
        'street',
    ];
}
