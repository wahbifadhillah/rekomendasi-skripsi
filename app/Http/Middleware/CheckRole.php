<?php

namespace App\Http\Middleware;

use Closure;


class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        $roles = [1,2]; // get array of your roles.

        // $request->user()->role IS AN EXAMPlE
        if(!in_array($request->user()->role, $roles)){
            return redirect('home')->with('error',"Only admin can access!");
        }
        // dd(in_array($request->user()->role, $roles);
        return $next($request);
    }
}
