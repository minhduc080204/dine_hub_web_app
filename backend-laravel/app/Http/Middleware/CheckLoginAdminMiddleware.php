<?php

namespace App\Http\Middleware;

use Closure;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckLoginAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            // Nếu chưa đăng nhập
            return $next($request);
        } else {
            if (Auth::user()->role == 'admin') {
                // toastr()->success('You have already logged in');
                return redirect()->route('admin.dashboard.index');
            } else {
                return $next($request);
            }
        }
    }
}