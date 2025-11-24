@extends('layouts.home.main')

@section('content')
<div class="d-flex flex-column gap-5 mt-5" style="margin: 0px 12px;">
    <div class="welfare">
        <div class="d-flex justify-content-between align-items-center mb-3 text-white">
            <h3 class="text-title">SHOP - MUA BÁN TÀI KHOẢN</h3>
            @if(auth()->check())
            <a href="{{ route('shop.create') }}" style="background: linear-gradient(135deg, #3366FF 0%, #0047AB 100%); color: white; padding: 10px 20px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 14px; display: inline-block;">
                + Đăng Bán
            </a>
            @else
            <a href="{{ route('login') }}" style="background: linear-gradient(135deg, #3366FF 0%, #0047AB 100%); color: white; padding: 10px 20px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 14px; display: inline-block;">
                + Đăng Bán
            </a>
            @endif
        </div>
        
        @if($accounts->isEmpty())
            <div class="alert alert-info text-center">
                <p>Không có tài khoản nào để bán</p>
            </div>
        @else
            <div class="accounts-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px;">
                @foreach($accounts as $account)
                    <div class="account-card" style="background: #1a1a1a; border-radius: 8px; overflow: hidden; transition: transform 0.3s ease;">
                        <!-- Account Image -->
                        <div style="position: relative; width: 100%; height: 200px; overflow: hidden; background: #333;">
                            @php
                                $images = $account->images;
                                if (is_string($images)) {
                                    $images = json_decode($images, true);
                                }
                                $images = is_array($images) ? $images : [];
                            @endphp
                            
                            @if(count($images) > 0)
                                <div class="account-image-carousel" style="position: relative; width: 100%; height: 100%;" data-images="{{ json_encode($images) }}">
                                    <img class="carousel-image" src="{{ $images[0] }}" alt="{{ $account->character_name }}" 
                                         style="width: 100%; height: 100%; object-fit: cover; display: block;">
                                    
                                    @if(count($images) > 1)
                                        <button class="carousel-prev" style="position: absolute; left: 5px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.6); border: none; color: white; width: 30px; height: 30px; border-radius: 50%; cursor: pointer; font-size: 18px; z-index: 10;">‹</button>
                                        <button class="carousel-next" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.6); border: none; color: white; width: 30px; height: 30px; border-radius: 50%; cursor: pointer; font-size: 18px; z-index: 10;">›</button>
                                        <div class="carousel-counter" style="position: absolute; bottom: 8px; right: 8px; background: rgba(0,0,0,0.7); color: white; padding: 4px 8px; border-radius: 4px; font-size: 11px; z-index: 10;">
                                            <span class="current-image">1</span>/<span class="total-images">{{ count($images) }}</span>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <img src="{{ asset('home/images/loading.png') }}" alt="{{ $account->character_name }}" 
                                     style="width: 100%; height: 100%; object-fit: cover; display: block;">
                            @endif
                            
                            <!-- Account Badge -->
                            <div style="position: absolute; top: 8px; right: 8px; background: rgba(51, 102, 255, 0.9); color: white; padding: 4px 12px; border-radius: 4px; font-size: 12px; font-weight: bold; z-index: 10;">
                                👁️ {{ $account->views ?? 0 }} lượt xem
                            </div>

                            <!-- Game Badge -->
                            <div style="position: absolute; bottom: 8px; left: 8px; background: rgba(0, 0, 0, 0.8); color: #00ff00; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: bold;">
                                🎮 {{ $account->game->game_name ?? 'N/A' }}
                            </div>
                        </div>

                        <!-- Account Info -->
                        <div style="padding: 16px; color: #f0f0f0;">
                            <h4 style="margin: 0 0 8px 0; font-size: 16px; font-weight: bold; text-align: left; color: #ffffff;">
                                {{ Str::limit($account->character_name, 50) }}
                            </h4>

                            <!-- Server Info -->
                            <div style="font-size: 12px; color: #999; margin-bottom: 12px; text-align: left;">
                                <p style="margin: 4px 0;">️ Server: {{ $account->server_name }}</p>
                                <p style="margin: 4px 0;">👤 Người bán: {{ $account->user->username ?? 'N/A' }}</p>
                            </div>

                            <!-- Price -->
                            <div style="font-size: 18px; color: #00ff00; font-weight: bold; margin-bottom: 12px; text-align: left;">
                                💰 {{ number_format($account->price) }} đ
                            </div>

                            <!-- Action Button -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                                <a href="{{ route('shop.show', $account->id) }}" data-ajax
                                   style="display: inline-block; padding: 10px; background: linear-gradient(135deg, #3366FF 0%, #0047AB 100%); color: white; text-align: center; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 13px; border: none; cursor: pointer; transition: opacity 0.3s ease;">
                                    Xem Chi Tiết
                                </a>
                                <a href="https://m.me/game.mobile.studio.phoenix?text=Xin%20chào%20admin%2C%20tôi%20muốn%20mua%20tài%20khoản%20{{ urlencode($account->character_name) }}%20game%20{{ urlencode($account->game->game_name ?? '') }}%20server%20{{ urlencode($account->server_name) }}%20giá%20{{ urlencode(number_format($account->price)) }}đ.%20Bạn%20có%20còn%20tài%20khoản%20này%20không?" target="_blank" rel="noopener noreferrer"
                                   style="display: inline-block; padding: 10px; background: linear-gradient(135deg, #0084FF 0%, #0063E1 100%); color: white; text-align: center; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 13px; border: none; cursor: pointer; transition: opacity 0.3s ease;">
                                    🛒 Mua Ngay
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
    .accounts-grid {
        animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .account-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .account-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(51, 102, 255, 0.2);
    }

    .account-card:hover img {
        transform: scale(1.05);
    }

    .account-card img {
        transition: transform 0.3s ease;
    }

    .carousel-image {
        transition: opacity 0.15s ease !important;
    }

    .carousel-prev:hover,
    .carousel-next:hover {
        background: rgba(0,0,0,0.8) !important;
    }
</style>

<script>
    function initCarousels() {
        document.querySelectorAll('.account-image-carousel').forEach(carousel => {
            // Skip if already initialized
            if (carousel.dataset.initialized === 'true') return;
            carousel.dataset.initialized = 'true';

            let currentIndex = 0;
            const images = JSON.parse(carousel.dataset.images);
            const img = carousel.querySelector('.carousel-image');
            const prevBtn = carousel.querySelector('.carousel-prev');
            const nextBtn = carousel.querySelector('.carousel-next');
            const counter = carousel.querySelector('.current-image');

            function showImage(index) {
                currentIndex = (index + images.length) % images.length;
                img.style.opacity = '0';
                setTimeout(() => {
                    img.src = images[currentIndex];
                    img.style.opacity = '1';
                }, 150);
                if (counter) {
                    counter.textContent = currentIndex + 1;
                }
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
        });
    }

    // Image carousel functionality
    document.addEventListener('DOMContentLoaded', function() {
        initCarousels();
    });

    // Listen for AJAX content load (from main.blade.php)
    document.addEventListener('ajaxContentLoaded', function() {
        initCarousels();
    });
</script>
@endsection