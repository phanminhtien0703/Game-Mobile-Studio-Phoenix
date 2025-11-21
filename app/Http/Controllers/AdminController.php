<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        // Kiểm tra đã đăng nhập chưa
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }
        
        return view('admin.admin');
    }

    public function login()
    {
        // Nếu đã đăng nhập thì redirect về dashboard
        if (Session::has('admin_id')) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required' => 'Vui lòng nhập email hoặc username',
            'password.required' => 'Vui lòng nhập mật khẩu',
        ]);

        // Tìm admin theo email hoặc username
        $admin = Admin::where('email', $request->login)
                     ->orWhere('username', $request->login)
                     ->first();

        if (!$admin) {
            return back()->withErrors(['login' => 'Email hoặc username không tồn tại'])->withInput();
        }

        // Kiểm tra mật khẩu
        if (!Hash::check($request->password, $admin->password_hash)) {
            return back()->withErrors(['password' => 'Mật khẩu không đúng'])->withInput();
        }

        // Lưu thông tin vào session
        Session::put('admin_id', $admin->admin_id);
        Session::put('admin_username', $admin->username);
        Session::put('admin_email', $admin->email);
        Session::put('admin_role', $admin->role);

        // Cập nhật last_login và last_ip
        $admin->update([
            'last_login' => now(),
            'last_activity' => now(),
            'last_ip' => $request->ip(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công!');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('admin.login')->with('success', 'Đăng xuất thành công!');
    }

    public function games()
    {
        return view('admin.games.index');
    }
}
