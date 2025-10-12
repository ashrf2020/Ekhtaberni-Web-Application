<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {

            $url = request()->path(); // أو $request->path()، يعطي الجزء بعد الدومين

            if ($url === app()->getLocale() . '/student/dashboard') {
                return route('selection');
            } 
            elseif ($url === app()->getLocale() . '/teacher/dashboard') {
                return route('selection');
            } 
            elseif ($url === app()->getLocale() . '/parent/dashboard') {
                return route('selection');
            } 
            else {
                return route('selection');
            }
        }
    }

}