<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthSession
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

        session_start();

        if(!isset($_SESSION['user'])){

            return redirect('/login/login');

        }


        return $next($request);
    }
}
