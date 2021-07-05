<?php

namespace App\Http\Middleware;
use Closure;


class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!auth()->check()){
            return redirect('login');
        }

        // $user = auth()->user();
        // dd($request->user()->role);
        // dd($roles);
        if (!in_array($request->user()->role, $roles)){
            return redirect('home')->with('error',"Only admin can access!");
        }
        
        return $next($request);
    }
}
