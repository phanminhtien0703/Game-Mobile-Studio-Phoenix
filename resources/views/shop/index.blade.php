@extends('layouts.home.main')

@section('content')
<div class="d-flex flex-column gap-5 mt-5" style="margin: 0px 12px;">
    <div class="welfare">
        <div class="d-flex justify-content-between align-items-center mb-3 text-white">
            <h3 class="text-title">MUA BÁN TÀI KHOẢN</h3>
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

            <!-- Pagination -->
            <div style="display: flex; justify-content: center; margin-top: 30px;">
                {{ $accounts->links() }}
            </div>
        @endif
    </div>
</div>

<style>
    /* ========== ANIMATIONS ========== */
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

    /* ========== GRID LAYOUT ========== */
    .accounts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
        animation: fadeIn 0.5s ease-in;
    }

    /* ========== ACCOUNT CARD ========== */
    .account-card {
        background: #1a1a1a;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .account-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(51, 102, 255, 0.2);
    }

    .account-card:hover img {
        transform: scale(1.05);
    }

    /* ========== IMAGE CAROUSEL ========== */
    .account-image-carousel {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .carousel-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.3s ease, opacity 0.15s ease;
    }

    .carousel-prev,
    .carousel-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.6);
        border: none;
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 18px;
        z-index: 10;
        transition: background 0.3s ease;
    }

    .carousel-prev {
        left: 5px;
    }

    .carousel-next {
        right: 5px;
    }

    .carousel-prev:hover,
    .carousel-next:hover {
        background: rgba(0, 0, 0, 0.8);
    }

    .carousel-counter {
        position: absolute;
        bottom: 8px;
        right: 8px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
        z-index: 10;
    }

    /* ========== BADGES ========== */
    .account-badge,
    .game-badge {
        position: absolute;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: bold;
        z-index: 10;
    }

    .account-badge {
        top: 8px;
        right: 8px;
        background: rgba(51, 102, 255, 0.9);
        color: white;
    }

    .game-badge {
        bottom: 8px;
        left: 8px;
        background: rgba(0, 0, 0, 0.8);
        color: #00ff00;
    }

    /* ========== ACCOUNT INFO ========== */
    .account-info {
        padding: 16px;
        color: #f0f0f0;
    }

    .account-title {
        margin: 0 0 8px 0;
        font-size: 16px;
        font-weight: bold;
        color: #ffffff;
        text-align: left;
    }

    .account-meta {
        font-size: 12px;
        color: #999;
        margin-bottom: 12px;
        text-align: left;
    }

    .account-meta p {
        margin: 4px 0;
    }

    .account-price {
        font-size: 18px;
        color: #00ff00;
        font-weight: bold;
        margin-bottom: 12px;
        text-align: left;
    }

    /* ========== ACTION BUTTONS ========== */
    .account-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    .btn-action {
        padding: 10px;
        color: white;
        text-align: center;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
        font-size: 13px;
        border: none;
        cursor: pointer;
        transition: opacity 0.3s ease;
    }

    .btn-detail {
        background: linear-gradient(135deg, #3366FF 0%, #0047AB 100%);
    }

    .btn-detail:hover {
        opacity: 0.9;
    }

    .btn-buy {
        background: linear-gradient(135deg, #0084FF 0%, #0063E1 100%);
    }

    .btn-buy:hover {
        opacity: 0.9;
    }
</style>

<script>
    /**
     * Account Image Carousel Manager
     * Handles image carousel functionality for account cards
     */
    const CarouselManager = {
        // ========== CONFIGURATION ==========
        config: {
            carouselSelector: '.account-image-carousel',
            imageSelector: '.carousel-image',
            prevBtnSelector: '.carousel-prev',
            nextBtnSelector: '.carousel-next',
            counterSelector: '.current-image',
            fadeTransitionDuration: 150,
            initAttribute: 'data-initialized'
        },

        // ========== STATE ==========
        carousels: new Map(),

        // ========== UTILITIES ==========
        /**
         * Parse images from data attribute
         * @param {HTMLElement} carousel - Carousel element
         * @returns {Array} Array of image URLs
         */
        parseImages(carousel) {
            try {
                return JSON.parse(carousel.dataset.images || '[]');
            } catch (error) {
                console.error('Error parsing images:', error);
                return [];
            }
        },

        /**
         * Normalize image index
         * @param {number} index - Image index
         * @param {number} length - Total images
         * @returns {number} Normalized index
         */
        normalizeIndex(index, length) {
            return (index + length) % length;
        },

        // ========== IMAGE DISPLAY ==========
        /**
         * Display image at specific index
         * @param {HTMLElement} carousel - Carousel element
         * @param {number} newIndex - New image index
         */
        showImage(carousel, newIndex) {
            const state = this.carousels.get(carousel);
            if (!state) return;

            const { images, img, counter } = state;
            state.currentIndex = this.normalizeIndex(newIndex, images.length);

            img.style.opacity = '0';
            setTimeout(() => {
                img.src = images[state.currentIndex];
                img.style.opacity = '1';
            }, this.config.fadeTransitionDuration);

            if (counter) {
                counter.textContent = state.currentIndex + 1;
            }
        },

        // ========== EVENT BINDING ==========
        /**
         * Bind navigation button events
         * @param {HTMLElement} carousel - Carousel element
         */
        bindEvents(carousel) {
            const state = this.carousels.get(carousel);
            if (!state) return;

            const { prevBtn, nextBtn } = state;

            if (prevBtn) {
                prevBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.showImage(carousel, state.currentIndex - 1);
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.showImage(carousel, state.currentIndex + 1);
                });
            }
        },

        // ========== INITIALIZATION ==========
        /**
         * Initialize carousel
         * @param {HTMLElement} carousel - Carousel element
         */
        init(carousel) {
            // Skip if already initialized
            if (carousel.dataset[this.config.initAttribute] === 'true') {
                return;
            }

            const images = this.parseImages(carousel);
            if (images.length === 0) return;

            // Store carousel state
            this.carousels.set(carousel, {
                currentIndex: 0,
                images: images,
                img: carousel.querySelector(this.config.imageSelector),
                prevBtn: carousel.querySelector(this.config.prevBtnSelector),
                nextBtn: carousel.querySelector(this.config.nextBtnSelector),
                counter: carousel.querySelector(this.config.counterSelector)
            });

            // Bind events
            this.bindEvents(carousel);

            // Mark as initialized
            carousel.dataset[this.config.initAttribute] = 'true';
        },

        /**
         * Initialize all carousels
         */
        initAll() {
            document.querySelectorAll(this.config.carouselSelector).forEach(carousel => {
                this.init(carousel);
            });
        },

        /**
         * Reinitialize carousels (for AJAX loaded content)
         */
        reinitialize() {
            // Clear previously initialized state
            document.querySelectorAll(this.config.carouselSelector).forEach(carousel => {
                carousel.dataset[this.config.initAttribute] = 'false';
            });
            this.carousels.clear();
            this.initAll();
        }
    };

    // ========== EVENT LISTENERS ==========
    document.addEventListener('DOMContentLoaded', function() {
        CarouselManager.initAll();
    });

    // Listen for AJAX content load (from main.blade.php)
    document.addEventListener('ajaxContentLoaded', function() {
        CarouselManager.reinitialize();
    });
</script>
@endsection