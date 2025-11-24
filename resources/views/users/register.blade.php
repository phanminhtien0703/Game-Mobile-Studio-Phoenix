@extends('layouts.home.main')

@section('content')
<div style="min-height: 600px; display: flex; align-items: center; justify-content: center; padding: 20px;">
    <div style="width: 100%; max-width: 450px;">
        <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            <h1 style="text-align: center; color: #333; margin-bottom: 30px; font-size: 28px;">Đăng Ký</h1>

            @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                <!-- Username -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Tên Đăng Nhập</label>
                    <input type="text" name="username" value="{{ old('username') }}" 
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box;" 
                           placeholder="Nhập tên đăng nhập (3-50 ký tự)" required>
                    @error('username')
                    <span style="color: #dc3545; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" 
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box;" 
                           placeholder="Nhập email" required>
                    @error('email')
                    <span style="color: #dc3545; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Mật Khẩu</label>
                    <input type="password" name="password" 
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box;" 
                           placeholder="Nhập mật khẩu (tối thiểu 6 ký tự)" required>
                    @error('password')
                    <span style="color: #dc3545; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Xác Nhận Mật Khẩu</label>
                    <input type="password" name="password_confirmation" 
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box;" 
                           placeholder="Xác nhận mật khẩu" required>
                    @error('password_confirmation')
                    <span style="color: #dc3545; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Register Button -->
                <button type="submit" style="width: 100%; padding: 12px; background: linear-gradient(135deg, #3366FF 0%, #0047AB 100%); color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 16px; margin-bottom: 15px;">
                    Đăng Ký
                </button>

                <!-- Login Link -->
                <div style="text-align: center; color: #666; font-size: 14px;">
                    Đã có tài khoản? 
                    <a href="{{ route('login') }}" style="color: #3366FF; text-decoration: none; font-weight: 600;">Đăng nhập ngay</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
