<?php 

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('/admin/users', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|unique:users',
            'password' => 'required|string',
            // 'avatar' => 'nullable|image',
            'role' => 'required|string',
        ], [
           'name.required' => 'حقل الاسم مطلوب.',
    'email.required' => 'حقل البريد الإلكتروني مطلوب.',
    'email.email' => 'يجب أن يكون البريد الإلكتروني صالحًا.',
    'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
    'phone.required' => 'حقل رقم الهاتف مطلوب.',
    'phone.unique' => 'رقم الهاتف مستخدم بالفعل.',
    'password.required' => 'حقل كلمة المرور مطلوب.',
    'role.required' => 'حقل الدور مطلوب.',
        ]);

        $request->merge(['role' => $request->role ?? 'موظف']);

        $user = User::create($request->all());

        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
            $user->save();
        }

        // if ($request->hasFile('avatar')) {
        //     $avatar = $request->file('avatar');
        //     $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
        //     $avatar->move(public_path('avatars'), $avatarName);
        //     $avatarPath = 'avatars/' . $avatarName;
        //     $user->avatar = $avatarPath;
        //     $user->save();
        // }

        toastr()->success('تمت الاضافة بنجاح ');
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|unique:users,phone,' . $id,
            'password' => 'nullable|string',
            'role' => 'nullable|string',
            // 'avatar' => 'nullable|image',
        ]);

        $user = User::findOrFail($id);
        // $user->update($request->except('password', 'avatar'));
        $user->update($request->except('password'));

        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
            $user->save();
        }

        // if ($request->hasFile('avatar')) {
        //     $avatar = $request->file('avatar');
        //     $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
        //     $avatar->move(public_path('avatars'), $avatarName);
        //     $avatarPath = 'avatars/' . $avatarName;
        //     $user->avatar = $avatarPath;
        //     $user->save();
        // }

        toastr()->success('تم تحديث البيانات ');
        return back();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        toastr()->success('تم الحذف بنجاح ');
        return back();
    }
}
