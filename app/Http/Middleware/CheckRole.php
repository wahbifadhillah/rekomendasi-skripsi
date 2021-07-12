<?php

namespace App\Http\Middleware;
use Closure;


class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!auth()->check()){
            return redirect('login')->with('error',"Anda harus login terlebih dahulu.");
        }

        $role = $request->user()->role;
        $route = $role == 'kaprodi' ? 'admin':'kjfd';
        if (!in_array($role, $roles)){
            return redirect($route.'/dashboard')->with('role_error',"Anda tidak mempunyai akses ke halaman tersebut.".$route);
        }
        return $next($request);
    }
}
