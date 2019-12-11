<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next,...$roles)
    // {
    //     if(in_array($request->user()->role,$roles)){
    //         return $next($request);
    //     }
    //     return redirect('/');
    // }

    public function handle($request, Closure $next,$role){
        if(!Auth::check()){
            return redirect('/');
        }
        return $next($request);
    }
}
