<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientData extends Model
{
    use HasFactory;
    protected $fillable = [
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

    public function getFullName()
    {
        return $this->getAttribute('name') . ' ' . $this->getAttribute('surname');
    }
}
