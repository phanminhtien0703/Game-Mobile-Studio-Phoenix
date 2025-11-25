@extends('layouts.home.main')

@section('content')

<div style="min-height: 600px; display: flex; align-items: center; justify-content: center; padding: 20px;">
    <div style="width: 100%; max-width: 450px;">
        <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            <h1 style="text-align: center; color: #333; margin-bottom: 30px; font-size: 28px;">Đăng Nhập</h1>

            @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <!-- Username -->
                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Tên Đăng Nhập</label>
                    <input type="text" name="username" value="{{ old('username') }}" 
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box;" 
                           placeholder="Nhập tên đăng nhập" required>
                    @error('username')
                    <span style="color: #dc3545; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Mật Khẩu</label>
                    <input type="password" name="password" 
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box;" 
                           placeholder="Nhập mật khẩu" required>
                    @error('password')
                    <span style="color: #dc3545; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Login Button -->
                <button type="submit" style="width: 100%; padding: 12px; background: linear-gradient(135deg, #3366FF 0%, #0047AB 100%); color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 16px; margin-bottom: 15px;">
                    Đăng Nhập
                </button>

                <!-- Register Link -->
                <div style="text-align: center; color: #666; font-size: 14px;">
                    Chưa có tài khoản? 
                    <a href="{{ route('register') }}" style="color: #3366FF; text-decoration: none; font-weight: 600;">Đăng ký ngay</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loginBannerSwiper = document.getElementById('loginBannerSwiper');
    if (loginBannerSwiper) {
        const swiper = new Swiper('#loginBannerSwiper', {
            slidesPerView: 1,
            spaceBetween: 0,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            loop: true,
        });
    }
});
</script>
@endsection
