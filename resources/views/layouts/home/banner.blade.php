<style>
    /* ========== WRAPPER & BASE STYLES ========== */
    .wrapper-slider {
        position: relative;
        width: 100%;
        overflow: hidden;
        border-radius: 8px;
        margin: 10px auto;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        aspect-ratio: 16 / 6;
        max-width: 100%;
    }

    /* ========== BANNER IMAGE STYLING ========== */
    .banner-image {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .item-banner {
        display: block;
        width: 100%;
        height: 100%;
        text-decoration: none;
        position: relative;
    }

    .item-banner:hover .banner-image {
        transform: scale(1.03);
    }

    /* ========== SWIPER SLIDE CONTAINER ========== */
    .swiper-slide {
        height: 100%;
        overflow: hidden;
    }

    /* ========== PAGINATION BULLET STYLES ========== */
    .swiper-pagination {
        position: absolute;
        bottom: 15px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
    }

    .swiper-pagination-bullet {
        background: rgba(255, 255, 255, 0.5);
        margin: 0 4px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        transition: all 0.3s ease;
        cursor: pointer;
        opacity: 1;
    }

    .swiper-pagination-bullet:hover {
        background: rgba(255, 255, 255, 0.8);
        transform: scale(1.2);
    }

    .swiper-pagination-bullet-active {
        background: rgba(255, 255, 255, 1);
        transform: scale(1.25);
    }

    /* ========== NAVIGATION BUTTON STYLES ========== */
    .swiper-button-next,
    .swiper-button-prev {
        color: rgba(255, 255, 255, 0.7);
        background: rgba(0, 0, 0, 0.3);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        transition: all 0.3s ease;
        backdrop-filter: blur(4px);
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        color: rgba(255, 255, 255, 1);
        background: rgba(0, 0, 0, 0.6);
        transform: scale(1.1);
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 20px;
        font-weight: bold;
    }

    /* ========== RESPONSIVE DESIGN ========== */
    @media (max-width: 768px) {
        .wrapper-slider {
            aspect-ratio: 16 / 6;
            margin: 8px auto;
            border-radius: 6px;
        }

        .swiper-pagination-bullet {
            width: 6px;
            height: 6px;
            margin: 0 3px;
        }

        .swiper-button-next,
        .swiper-button-prev {
            width: 38px;
            height: 38px;
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 18px;
        }
    }

    @media (max-width: 480px) {
        .wrapper-slider {
            aspect-ratio: 16 / 6;
            margin: 5px auto;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .banner-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .swiper-pagination-bullet {
            width: 5px;
            height: 5px;
            margin: 0 2px;
        }

        .swiper-button-next,
        .swiper-button-prev {
            width: 32px;
            height: 32px;
            background: rgba(0, 0, 0, 0.4);
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 14px;
        }
    }
</style>

<section class="wrapper-slider" role="region" aria-label="Game Banner Carousel">
    <h1 style="position: absolute; left: -9999px;">Game Mobile Studio - Phoenix | Cổng Game Online Hàng Đầu</h1>
    
    <div class="swiper" id="bannerSwiper">
        <div class="swiper-wrapper">
            {{-- Display banner games or fallback --}}
            @forelse($bannerGames ?? [] as $game)
                <div class="swiper-slide">
                    <a target="_blank" 
                       class="item-banner" 
                       href="{{ $game->download_link ?? $game->fanpage_support ?? '#' }}"
                       rel="noopener noreferrer"
                       title="{{ $game->game_name ?? 'Game Banner' }}">
                        <img class="banner-image" 
                             alt="{{ $game->game_name ?? 'Game Banner' }}" 
                             src="{{ $game->banner_url ? asset($game->banner_url) : 'https://gamemobilestudio.cloud/images/pattern-bg.png' }}"
                             loading="lazy">
                    </a>
                </div>
            @empty
                {{-- Fallback banner when no games available --}}
                <div class="swiper-slide">
                    <a target="_blank" 
                       class="item-banner" 
                       href="#"
                       title="Default Banner">
                        <img class="banner-image" 
                             alt="Default Banner" 
                             src="https://gamemobilestudio.cloud/images/pattern-bg.png"
                             loading="lazy">
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="swiper-pagination"></div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const swiper = new Swiper('#bannerSwiper', {
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
});
</script>
