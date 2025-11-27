<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }
        // التوجيه إلى الصفحة الرئيسية (/) إذا لم يكن الدور مطابقاً
        return redirect('/');
    }
}