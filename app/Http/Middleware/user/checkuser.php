<?php

namespace App\Http\Middleware\user;

use Closure;

class checkuser
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
    if(auth()->user()->is_admin==0){
        return redirect()->route('user_dashboard');
    }else {
      return $next($request);
    }
    }
}
