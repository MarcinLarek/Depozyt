<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    protected $guard = "admin";
    protected $fillable = [
        'login',
        'name',
        'surname',
        'token',
        'email',
        'error_notification',
        'password',
    ];
}
