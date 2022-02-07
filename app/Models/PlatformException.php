<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformException extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'date', 'controller', 'method', 'message', 'client_ip', 'user_id'
    ];
}
