<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->quyenID == 1) {
            return $next($request);
        }
        
        return redirect()->route('404')->with('error', 'Bạn không có quyền truy cập.');
    }
}