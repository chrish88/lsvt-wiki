<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
                
        $reqEmail = json_decode($request->getContent(), true);
        $domain = explode('@', $reqEmail["email"]);
       
        if($domain[1] != 'lightspeedvt.com'){
            return redirect()->route('register');
        }
        return $next($request);
    }
}
