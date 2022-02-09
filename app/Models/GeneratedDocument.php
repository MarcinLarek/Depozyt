<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratedDocument extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'file_name', 'disk', 'created_at'
    ];

    public function getFileName()
    {
        return $this->getAttribute('file_name');
    }
}
