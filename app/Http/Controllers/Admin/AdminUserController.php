<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'username' => 'required|string|unique:users,username|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'status' => 'required|in:active,inactive,banned',
        ], [
            'username.required' => 'Tên đăng nhập không được để trống',
            'username.unique' => 'Tên đăng nhập đã tồn tại',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không trùng khớp',
            'status.required' => 'Trạng thái không được để trống',
        ]);

        // Hash password
        $validated['password_hash'] = Hash::make($validated['password']);
        unset($validated['password']);

        // Create user
        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'Tạo người dùng thành công!');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate input
        $validated = $request->validate([
            'username' => 'required|string|unique:users,username,' . $user->user_id . ',user_id|max:255',
            'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'status' => 'required|in:active,inactive,banned',
        ], [
            'username.required' => 'Tên đăng nhập không được để trống',
            'username.unique' => 'Tên đăng nhập đã tồn tại',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'password.min' => 'Mật khẩu phải ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không trùng khớp',
            'status.required' => 'Trạng thái không được để trống',
        ]);

        // Hash password if provided
        if (!empty($validated['password'])) {
            $validated['password_hash'] = Hash::make($validated['password']);
            unset($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Update user
        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật người dùng thành công!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Xóa người dùng thành công!');
    }

    public function show($user_id)
    {
        $user = User::find($user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'user_id' => $user->user_id,
            'username' => $user->username,
            'email' => $user->email,
            'status' => $user->status,
            'last_login' => $user->last_login,
            'last_ip' => $user->last_ip,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ]);
    }
}
