<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\BannerHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showLogin()
    {
        if (auth()->check()) {
            return redirect()->route('home.index');
        }

        $bannerGames = BannerHelper::getBannerGames();
        return view('users.login', compact('bannerGames'));
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Tên đăng nhập không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
        ]);

        // Kiểm tra đăng nhập
        $user = User::where('username', $validated['username'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password_hash)) {
            return back()->withErrors([
                'username' => 'Tên đăng nhập hoặc mật khẩu không chính xác',
            ])->onlyInput('username');
        }

        // Cập nhật last_login
        $user->update([
            'last_login' => now(),
            'last_ip' => $request->ip(),
        ]);

        // Đăng nhập
        Auth::guard('web')->login($user);

        return redirect()->intended(route('home.index'))->with('success', 'Đăng nhập thành công');
    }

    public function showRegister()
    {
        if (auth()->check()) {
            return redirect()->route('home.index');
        }

        $bannerGames = BannerHelper::getBannerGames();
        return view('users.register', compact('bannerGames'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:users,username|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'username.required' => 'Tên đăng nhập không được để trống',
            'username.unique' => 'Tên đăng nhập đã tồn tại',
            'username.min' => 'Tên đăng nhập tối thiểu 3 ký tự',
            'username.max' => 'Tên đăng nhập tối đa 50 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã được đăng ký',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password_hash' => Hash::make($validated['password']),
            'status' => 'active',
            'created_at' => now(),
        ]);

        Auth::guard('web')->login($user);

        return redirect()->route('home.index')->with('success', 'Đăng ký thành công');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home.index')->with('success', 'Đăng xuất thành công');
    }
}
