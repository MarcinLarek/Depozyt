<?php

return [

    'defaults' => [
        'guard' => 'client',
        'passwords' => 'users',
    ],

    'guards' => [
        'client' => [
            'driver' => 'session',
            'provider' => "users",
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => "admins"
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],
    'password_timeout' => 10800,
];