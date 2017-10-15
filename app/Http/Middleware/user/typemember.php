<?php

namespace App\Http\Middleware\user;

use Closure;

class typemember
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
      if(auth()->user()->is_admin){
        return redirect()->route('admin_dashboard');
    }else {
      return $next($request);
    }
    }
}
