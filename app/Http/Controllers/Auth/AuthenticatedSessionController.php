<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\SiteData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
                $data = SiteData::first();

        return view('auth.login',compact('data'));
    }

    /**
     * Handle an incoming authentication request.
     */// ...
// في دالة store

    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. محاولة المصادقة: إذا فشلت (أرجعت false)
        if (! $request->authenticate()) { 
            
            // 2. نعود إلى الخلف مع رسالة خطأ عامة في الجلسة
            return redirect()->back()->with('error', trans('auth.failed'));
        }

        // 3. إذا نجحت المصادقة
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }
// ...
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
