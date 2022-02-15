<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        $domain = $request->route()->domain();
        if(str_contains($domain,'admin.')) {
            $signInRouteName = 'admin.sign-in';
        }
        else {
            $signInRouteName = 'client.sign-in';
        }

        return route($signInRouteName);
        if (!$request->expectsJson()) {

        }
    }
}
