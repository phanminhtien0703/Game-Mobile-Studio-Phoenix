@extends('layouts.home.main')

@section('content')
<div style="padding: 20px; min-height: 600px;">
    <div style="max-width: 800px; margin: 0 auto;">
        <a href="{{ route('shop.index') }}" style="color: #3366FF; text-decoration: none; margin-bottom: 20px; display: inline-block; font-weight: 600;">← Quay lại</a>

        <h1 style="font-size: 28px; color: #333; margin-bottom: 30px; margin-top: 20px;">Đăng Bán Tài Khoản Game</h1>

        @if($errors->any())
        <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Success Modal -->
        @if(session('success_pending'))
        @php
            $accountData = session('account_data', []);
        @endphp
        <div id="successModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); display: flex; align-items: center; justify-content: center; z-index: 9999;">
            <div style="background: white; padding: 40px; border-radius: 12px; max-width: 400px; text-align: center; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);">
                <div style="font-size: 50px; margin-bottom: 20px;">✅</div>
                <h2 style="color: #333; margin-bottom: 15px; font-size: 22px;">{{ session('success_pending') }}</h2>
                <p style="color: #666; margin-bottom: 25px; line-height: 1.6;">
                    Tài khoản của bạn đã được gửi để duyệt.<br>
                    Admin sẽ xem xét phê duyệt và hỗ trợ trung gian khi giao dịch.
                </p>
                <button id="okBtn" 
                        data-character-name="{{ $accountData['character_name'] ?? '' }}"
                        data-server-name="{{ $accountData['server_name'] ?? '' }}"
                        data-game-name="{{ $accountData['game_name'] ?? '' }}"
                        style="background: linear-gradient(135deg, #3366FF 0%, #0047AB 100%); color: white; padding: 12px 40px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 16px;">
                    OK
                </button>
            </div>
        </div>
        @endif

        <form action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            @csrf

            <!-- Game Select -->
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Chọn Trò Chơi *</label>
                <select name="game_id" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box;" required>
                    <option value="">-- Chọn trò chơi --</option>
                    @foreach($games as $game)
                    <option value="{{ $game->game_id }}" {{ old('game_id') == $game->game_id ? 'selected' : '' }}>
                        {{ $game->game_name }}
                    </option>
                    @endforeach
                </select>
                @error('game_id')
                <span style="color: #dc3545; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Character Name -->
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Tên Nhân Vật *</label>
                <input type="text" name="character_name" value="{{ old('character_name') }}" 
                       style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box;" 
                       placeholder="Nhập tên nhân vật" required>
                @error('character_name')
                <span style="color: #dc3545; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Server Name -->
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Tên Máy Chủ *</label>
                <input type="text" name="server_name" value="{{ old('server_name') }}" 
                       style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box;" 
                       placeholder="Nhập tên máy chủ" required>
                @error('server_name')
                <span style="color: #dc3545; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Price -->
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Giá (đ) *</label>
                <input type="number" name="price" value="{{ old('price') }}" 
                       style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box;" 
                       placeholder="Nhập giá" min="0" step="1000" required>
                @error('price')
                <span style="color: #dc3545; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Mô Tả</label>
                <textarea name="description" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; box-sizing: border-box; resize: vertical; min-height: 100px;" 
                          placeholder="Mô tả chi tiết về tài khoản...">{{ old('description') }}</textarea>
                @error('description')
                <span style="color: #dc3545; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Images Upload -->
            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #333; margin-bottom: 8px;">Ảnh (Tối Đa 5 ảnh) *</label>
                <input type="file" name="images[]" id="imageInput" multiple accept="image/*"
                       style="width: 100%; padding: 12px; border: 2px dashed #ddd; border-radius: 6px; background: #f9f9f9; cursor: pointer;"
                       onchange="previewImages(this)" required>
                @error('images')
                <span style="color: #dc3545; font-size: 13px; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image Preview -->
            <div id="previewContainer" style="margin-bottom: 25px; display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 10px;"></div>

            <!-- Form Buttons -->
            <div style="display: flex; gap: 12px; justify-content: center;">
                <button type="submit" style="background: linear-gradient(135deg, #3366FF 0%, #0047AB 100%); color: white; padding: 12px 32px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; font-size: 16px;">
                    Đăng Bán
                </button>
                <a href="{{ route('shop.index') }}" style="background: #e0e0e0; color: #333; padding: 12px 32px; border-radius: 6px; text-decoration: none; font-weight: 600; display: inline-block; cursor: pointer; font-size: 16px;">
                    Hủy
                </a>
            </div>
        </form>
    </div>
</div>

<script>
// Handle OK button click - Send message to Messenger
document.addEventListener('DOMContentLoaded', function() {
    const okBtn = document.getElementById('okBtn');
    if (okBtn) {
        okBtn.addEventListener('click', function() {
            const characterName = this.getAttribute('data-character-name');
            const serverName = this.getAttribute('data-server-name');
            const gameName = this.getAttribute('data-game-name');
            
            // Compose the message
            const message = `Chào admin tôi có đăng bán account\nTên nhân vật: ${characterName} - ${serverName}\n${gameName} ở trang Game Mobile Studio\nMong admin duyệt và hỗ trợ làm trung gian giao dịch giúp tôi`;
            
            // Encode message for URL
            const encodedMessage = encodeURIComponent(message);
            
            // Open Messenger with pre-filled message
            window.open(`https://m.me/game.mobile.studio.phoenix?text=${encodedMessage}`, '_blank');
        });
    }
});

function previewImages(input) {
    const container = document.getElementById('previewContainer');
    container.innerHTML = '';
    
    if (input.files.length > 5) {
        alert('Tối đa 5 ảnh');
        input.value = '';
        return;
    }

    Array.from(input.files).forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = (e) => {
            const div = document.createElement('div');
            div.style.cssText = 'position: relative; border-radius: 6px; overflow: hidden; background: #f0f0f0; aspect-ratio: 1;';
            div.innerHTML = `
                <img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover;">
                <button type="button" onclick="this.parentElement.remove()" style="position: absolute; top: 5px; right: 5px; background: rgba(255,0,0,0.7); color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer; font-size: 16px; padding: 0;">×</button>
            `;
            container.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}
</script>
@endsection
