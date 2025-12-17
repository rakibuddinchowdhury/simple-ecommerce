<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->role == '1'){ // 1 = Admin
                return $next($request);
            } else {
                return redirect('/')->with('error', 'Access Denied! You are not an Admin.');
            }
        } else {
            return redirect('/login')->with('error', 'Please Login First');
        }
    }
}