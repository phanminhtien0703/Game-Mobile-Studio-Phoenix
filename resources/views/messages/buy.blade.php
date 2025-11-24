@extends('layouts.home.main')

@section('content')
<div style="padding: 20px; min-height: 600px;">
    <div style="max-width: 600px; margin: 0 auto;">
        <a href="{{ route('shop.index') }}" style="color: #3366FF; text-decoration: none; margin-bottom: 20px; display: inline-block; font-weight: 600;">← Quay lại</a>

        <h1 style="font-size: 28px; color: #333; margin-bottom: 30px; margin-top: 20px;">Yêu Cầu Mua Tài Khoản</h1>

        <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <!-- Game & Character Info -->
            <div style="background: #f5f5f5; padding: 15px; border-radius: 8px; margin-bottom: 25px;">
                <p style="margin: 8px 0; font-size: 14px; color: #666;">
                    <strong>🎮 Game:</strong> {{ $game }}
                </p>
                <p style="margin: 8px 0; font-size: 14px; color: #666;">
                    <strong>👤 Tài khoản:</strong> {{ $character }}
                </p>
            </div>

            <!-- Message Form -->
            <form action="{{ route('message.send') }}" method="POST" style="background: white;">
                @csrf
                <input type="hidden" name="account_id" value="{{ $accountId }}">

                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Tin Nhắn *</label>
                    <textarea name="message" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box; resize: vertical; min-height: 120px;" required>{{ $message }}</textarea>
                    @error('message')
                    <span style="color: #dc3545; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="background: #e3f2fd; padding: 12px; border-radius: 6px; margin-bottom: 25px; font-size: 13px; color: #1565c0;">
                    <strong>ℹ️ Lưu ý:</strong> Admin sẽ liên hệ với bạn sớm nhất để xác nhận tài khoản còn hay không, thương lượng giá và hướng dẫn thanh toán.
                </div>

                <!-- Form Buttons -->
                <div style="display: flex; gap: 12px; justify-content: center;">
                    <button type="submit" style="background: linear-gradient(135deg, #00c853 0%, #00a83f 100%); color: white; padding: 12px 32px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 16px;">
                        ✓ Gửi Yêu Cầu
                    </button>
                    <a href="{{ route('shop.index') }}" style="background: #e0e0e0; color: #333; padding: 12px 32px; border-radius: 6px; text-decoration: none; font-weight: 600; display: inline-block; cursor: pointer; font-size: 16px;">
                        Hủy
                    </a>
                </div>
            </form>
        </div>

        <!-- Contact Info -->
        <div style="margin-top: 40px; padding: 20px; background: #fff3e0; border-radius: 8px; border-left: 4px solid #ff9800;">
            <h3 style="margin-top: 0; color: #e65100;">📞 Liên Hệ Trực Tiếp Với Admin</h3>
            <p style="margin: 10px 0; font-size: 14px;">
                <strong>Zalo/Phone:</strong> <a href="tel:0123456789" style="color: #ff9800; text-decoration: none;">0123 456 789</a>
            </p>
            <p style="margin: 10px 0; font-size: 14px;">
                <strong>Email:</strong> <a href="mailto:admin@gamemobilestudio.com" style="color: #ff9800; text-decoration: none;">admin@gamemobilestudio.com</a>
            </p>
            <p style="margin: 10px 0; font-size: 14px;">
                <strong>Facebook:</strong> <a href="https://facebook.com" target="_blank" style="color: #ff9800; text-decoration: none;">Game Mobile Studio</a>
            </p>
        </div>
    </div>
</div>
@endsection
