<?php

namespace App\Http\Middleware;

use Closure;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(auth()->user()->isAdmin() && $role=='admin'){
            return $next($request);
        } 
        
        if($role=='user'){
            return $next($request);
        } 
        
        else {
            return abort(401);
        }
        
    }
}
