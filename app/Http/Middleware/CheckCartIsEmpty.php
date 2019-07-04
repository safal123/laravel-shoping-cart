<?php

namespace App\Http\Middleware;

use Closure;
use Cart;

class CheckCartIsEmpty
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
        $count = Cart::content()->count();
        if($count <= 0){
          return redirect('/products');
        }
        return $next($request);
    }
}
