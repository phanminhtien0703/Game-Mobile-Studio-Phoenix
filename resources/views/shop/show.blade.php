@extends('layouts.home.main')

@section('content')
<div style="padding: 20px; min-height: 600px;">
    <div style="max-width: 1000px; margin: 0 auto;">
        <a href="{{ route('shop.index') }}" data-ajax style="color: #3366FF; text-decoration: none; margin-bottom: 20px; display: inline-block; font-weight: 600;">← Quay lại</a>

        <div style="display: grid; grid-template-columns: 1fr; gap: 30px; margin-top: 20px;">
            <!-- Top: Images -->
            <div style="background: #1a1a1a; border-radius: 12px; overflow: hidden; padding: 20px;">
                @php
                    $images = $account->images;
                    if (is_string($images)) {
                        $images = json_decode($images, true);
                    }
                    $images = is_array($images) ? $images : [];
                @endphp

                @if(count($images) > 0)
                    <div class="account-detail-carousel" style="position: relative; width: 100%; aspect-ratio: 16/9; background: #333; border-radius: 8px; overflow: hidden;" data-images="{{ json_encode($images) }}">
                        <img class="carousel-image-detail" src="{{ $images[0] }}" alt="{{ $account->character_name }}" 
                             style="width: 100%; height: 100%; object-fit: cover; display: block;">
                        
                        @if(count($images) > 1)
                            <button class="carousel-prev-detail" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.7); border: none; color: white; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; font-size: 20px; z-index: 10; display: flex; align-items: center; justify-content: center;">‹</button>
                            <button class="carousel-next-detail" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.7); border: none; color: white; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; font-size: 20px; z-index: 10; display: flex; align-items: center; justify-content: center;">›</button>
                            <div style="position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%); background: rgba(0,0,0,0.8); color: white; padding: 6px 12px; border-radius: 20px; font-size: 12px; z-index: 10;">
                                <span class="current-image-detail">1</span>/<span class="total-images-detail">{{ count($images) }}</span>
                            </div>
                        @endif
                    </div>

                    @if(count($images) > 1)
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 10px; margin-top: 15px;">
                        @foreach($images as $index => $image)
                        <img src="{{ $image }}" alt="Ảnh {{ $index + 1 }}" 
                             class="thumbnail-image" data-index="{{ $index }}"
                             style="width: 100%; height: 100px; object-fit: cover; border-radius: 6px; cursor: pointer; border: 2px solid transparent; transition: border 0.3s;" />
                        @endforeach
                    </div>
                    @endif
                @else
                    <img src="{{ asset('home/images/loading.png') }}" alt="{{ $account->character_name }}" 
                         style="width: 100%; aspect-ratio: 16/9; object-fit: cover; border-radius: 8px;">
                @endif
            </div>

            <!-- Bottom: Details -->
            <div style="display: grid; grid-template-columns: 1fr; gap: 20px;">
                <!-- Game & Status -->
                <div style="background: #f0f0f0; padding: 15px; border-radius: 8px;">
                    <p style="margin: 0; font-size: 12px; color: #999; text-transform: uppercase; letter-spacing: 1px;">{{ $account->game->game_name ?? 'N/A' }}</p>
                    <h1 style="margin: 10px 0 0 0; font-size: 28px; color: #333;">{{ $account->character_name }}</h1>
                    <p style="margin: 8px 0; font-size: 13px; color: #666;">
                        <strong>Status:</strong> 
                        @if($account->status === 'approved')
                            <span style="background: #4caf50; color: white; padding: 4px 8px; border-radius: 4px;">✓ Có sẵn</span>
                        @elseif($account->status === 'pending')
                            <span style="background: #ff9800; color: white; padding: 4px 8px; border-radius: 4px;">⏳ Chờ duyệt</span>
                        @else
                            <span style="background: #f44336; color: white; padding: 4px 8px; border-radius: 4px;">✗ Đã bán</span>
                        @endif
                    </p>
                </div>

                <!-- Info Box with Price -->
                <div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
                    <h3 style="margin: 0 0 15px 0; font-size: 16px; color: #333;">Thông Tin Chi Tiết</h3>
                    
                    <div style="margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #eee;">
                        <p style="margin: 0; font-size: 12px; color: #999;">🎮 TRÒ CHƠI</p>
                        <p style="margin: 5px 0 0 0; font-size: 14px; color: #333; font-weight: 600;">{{ $account->game->game_name ?? 'N/A' }}</p>
                    </div>

                    <div style="margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #eee;">
                        <p style="margin: 0; font-size: 12px; color: #999;">👤 TÊN NHÂN VẬT</p>
                        <p style="margin: 5px 0 0 0; font-size: 14px; color: #333; font-weight: 600;">{{ $account->character_name }}</p>
                    </div>

                    <div style="margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #eee;">
                        <p style="margin: 0; font-size: 12px; color: #999;">🗺️ MÁY CHỦ</p>
                        <p style="margin: 5px 0 0 0; font-size: 14px; color: #333; font-weight: 600;">{{ $account->server_name }}</p>
                    </div>

                    <div style="margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #eee;">
                        <p style="margin: 0; font-size: 12px; color: #999;">👁️ LƯỢT XEM</p>
                        <p style="margin: 5px 0 0 0; font-size: 14px; color: #333; font-weight: 600;">{{ $account->views ?? 0 }} lượt</p>
                    </div>

                    <div style="margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #eee;">
                        <p style="margin: 0; font-size: 12px; color: #999;">👤 NGƯỜI BÁN</p>
                        <p style="margin: 5px 0 0 0; font-size: 14px; color: #333; font-weight: 600;">{{ $account->user->username ?? 'N/A' }}</p>
                    </div>

                    <div style="margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #eee;">
                        <p style="margin: 0; font-size: 12px; color: #999;">📅 NGÀY ĐĂNG</p>
                        <p style="margin: 5px 0 0 0; font-size: 14px; color: #333; font-weight: 600;">{{ $account->created_at->format('d/m/Y') }}</p>
                    </div>

                    <!-- Price in Info Box -->
                    <div style="margin-bottom: 0; background: linear-gradient(135deg, #00c853 0%, #00a83f 100%); color: white; padding: 15px; border-radius: 6px; text-align: center; margin-top: 15px;">
                        <p style="margin: 0; font-size: 12px; opacity: 0.9; font-weight: 600;">GIÁ BÁN</p>
                        <h2 style="margin: 8px 0 0 0; font-size: 26px; font-weight: bold;">{{ number_format($account->price) }}đ</h2>
                    </div>
                </div>

                <!-- Description -->
                @if($account->description)
                <div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid #ddd;">
                    <h3 style="margin: 0 0 10px 0; font-size: 16px; color: #333;">Mô Tả</h3>
                    <p style="margin: 0; font-size: 14px; color: #666; line-height: 1.6;">{{ $account->description }}</p>
                </div>
                @endif

                <!-- Action Buttons -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <a href="https://m.me/game.mobile.studio.phoenix?text=Xin%20chào%20admin%2C%20tôi%20muốn%20mua%20tài%20khoản%20{{ urlencode($account->character_name) }}%20game%20{{ urlencode($account->game->game_name ?? '') }}%20server%20{{ urlencode($account->server_name) }}%20giá%20{{ urlencode(number_format($account->price)) }}đ.%20Bạn%20có%20còn%20tài%20khoản%20này%20không?" target="_blank" rel="noopener noreferrer"
                       style="display: inline-block; padding: 12px; background: linear-gradient(135deg, #0084FF 0%, #0063E1 100%); color: white; text-align: center; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 15px; cursor: pointer;">
                        💬 Liên Hệ Qua Messenger
                    </a>
                    <button onclick="history.back()" 
                       style="display: inline-block; padding: 12px; background: #e0e0e0; color: #333; text-align: center; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 15px; cursor: pointer; border: none;">
                        ← Quay Lại
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .carousel-image-detail {
        transition: opacity 0.15s ease;
    }

    .carousel-prev-detail:hover,
    .carousel-next-detail:hover {
        background: rgba(0,0,0,0.9) !important;
    }

    .thumbnail-image {
        opacity: 0.6;
        transition: opacity 0.3s, border 0.3s;
    }

    .thumbnail-image.active {
        opacity: 1;
        border-color: #0084FF !important;
    }

    .thumbnail-image:hover {
        opacity: 1;
    }
</style>

<script>
    function initDetailCarousel() {
        const carousel = document.querySelector('.account-detail-carousel');
        if (!carousel) return;
        
        // Skip if already initialized
        if (carousel.dataset.initialized === 'true') return;
        carousel.dataset.initialized = 'true';

        let currentIndex = 0;
        const images = JSON.parse(carousel.dataset.images);
        const img = carousel.querySelector('.carousel-image-detail');
        const prevBtn = carousel.querySelector('.carousel-prev-detail');
        const nextBtn = carousel.querySelector('.carousel-next-detail');
        const counterCurrent = carousel.querySelector('.current-image-detail');
        const thumbnails = document.querySelectorAll('.thumbnail-image');

        function showImage(index) {
            currentIndex = (index + images.length) % images.length;
            img.style.opacity = '0';
            setTimeout(() => {
                img.src = images[currentIndex];
                img.style.opacity = '1';
            }, 150);
            if (counterCurrent) {
                counterCurrent.textContent = currentIndex + 1;
            }
            updateThumbnails();
        }

        function updateThumbnails() {
            thumbnails.forEach((thumb, idx) => {
                if (idx === currentIndex) {
                    thumb.classList.add('active');
                } else {
                    thumb.classList.remove('active');
                }
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', (e) => {
                e.preventDefault();
                showImage(currentIndex - 1);
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', (e) => {
                e.preventDefault();
                showImage(currentIndex + 1);
            });
        }

        thumbnails.forEach((thumb, idx) => {
            thumb.addEventListener('click', () => {
                showImage(idx);
            });
        });

        updateThumbnails();
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        initDetailCarousel();
    });

    // Listen for AJAX content load (from main.blade.php)
    document.addEventListener('ajaxContentLoaded', function() {
        initDetailCarousel();
    });
</script>
@endsection
