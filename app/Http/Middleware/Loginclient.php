<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class Loginclient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if($request->is('login') && Auth::guard("client")->check()){
            return redirect("/");
        }
        if(!$request->is('login') && !Auth::guard("client")->check()){
            return redirect("login");
        }
        

        return $next($request);
    }
}
