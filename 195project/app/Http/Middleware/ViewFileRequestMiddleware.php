<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class ViewFileRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
		if(Auth::user()->type_id == 1 || Auth::user()->type_id == 4){
			return redirect()->back();
		}
		return $next($request);
    }
}