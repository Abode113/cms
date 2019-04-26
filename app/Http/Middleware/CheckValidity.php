<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class CheckValidity
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
        //dd('hey');
        dd('hey');
        if(Auth::check()) {
            return $next($request);
        }
        return redirect('/login')->withErrors(['msg', "you can't access here"]);
//        if(Auth::user()->description=='dataentry_role_description')
//
//        { return $next($request);}
//        return redirect('/login')->withErrors(['msg', "you can't access here"]);
    }
}




//if($this->user) {
//    if (!$this->user->hasRole(['enduser_role_name', 'dataentry_role_name', 'admin_role_name'])) {
//        Auth::logout();
//        return abort(403);
//    }
