<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(\Illuminate\Http\Request  $request, Closure $next)
    {
        dd([
            're' => $request->route()
        ]);
//        if (Auth::user() ) {
//            return redirect('home');
//        }
        return $next($request);
    }
}
