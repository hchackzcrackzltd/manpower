<?php

namespace App\Http\Middleware\user;

use Closure;

class checkmasterdata
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
      if($request->user()->getrole()->where('menu',3)->first()!==null){
        return $next($request);
      }else {
        abort(403);
      }

    }
}
