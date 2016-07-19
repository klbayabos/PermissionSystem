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
		if(Auth::user()->type_id == 2 || Auth::user()->type_id != 3 || Auth::user()->type_id != 5 || Auth::user()->type_id != 6 || Auth::user()->type_id != 7){
			return redirect()->back();
		}
		return $next($request);
    }
}