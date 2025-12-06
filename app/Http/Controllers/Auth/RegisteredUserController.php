<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
   public function store(Request $request): RedirectResponse
{
    try {
        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'phone' => ['required', 'string', 'max:255','unique:' . User::class],
                // 'role' => ['required', 'in:موظف,مدير,مشرف'],
            ],
            [
                'name.required' => 'الاسم مطلوب.',
                'email.required' => 'البريد الإلكتروني مطلوب.',
                'password.required' => 'كلمة المرور مطلوبة.',
                'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',    
                'email.unique' => 'البريد الإلكتروني مُسجل بالفعل.', 
                'phone.required' => 'رقم الجوال مطلوب.',
                 'phone.unique' => 'رقم الجوال مُسجل بالفعل.',
                'role.required' => 'الدور مطلوب.',
                // 'role.in' => 'الدور المحدد غير مسموح. القيم المسموحة: موظف، مدير، مشرف.',
            ]
        );

        $user = User::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'موظف',
        ]);

        event(new Registered($user));
        Auth::login($user);

        // رسالة نجاح
        return redirect()
            ->route('dashboard')
            ->with('success', "تم إنشاء الحساب بنجاح كـ {$user->role}، أهلاً يا {$user->name}!");
    } catch (\Exception $e) {
        // هنا تكتب المشكلة وترجعها للمستخدم
        return back()
            ->withInput()
            ->with('error', 'حدثت مشكلة أثناء إنشاء الحساب: ' . $e->getMessage());
    }
}
}
