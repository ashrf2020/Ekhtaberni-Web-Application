<?php

namespace App\Http\Traits;

use App\Providers\RouteServiceProvider;

trait AuthTrait
{
    public function checkGuard($request){

        if($request->type == 'student'){
            $guardName= 'student';
        }
        elseif ($request->type == 'parent'){
            $guardName= 'parent';
        }
        elseif ($request->type == 'teacher'){
            $guardName= 'teacher';
        }
        else{
            $guardName= 'web';
        }
        return $guardName;
    }

    public function redirect($request){

        if($request->type == 'student'){
            return redirect(RouteServiceProvider::STUDENT);
        }
        elseif ($request->type == 'parent'){
            return redirect(RouteServiceProvider::PARENT);
        }
        elseif ($request->type == 'teacher'){
            return redirect(RouteServiceProvider::TEACHER);
        }
        else{
            return redirect(RouteServiceProvider::HOME);
        }
    }
}