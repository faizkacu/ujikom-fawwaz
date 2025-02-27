<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin.');
        }
        return $next($request);
    }
}
