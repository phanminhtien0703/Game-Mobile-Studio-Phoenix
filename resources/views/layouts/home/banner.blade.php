<style>
    .wrapper-slider {
        overflow: hidden;
        position: relative;
        width: 100%;
    }

    .wrapper-slider .banner-image {
        display: block;
        width: 100%;
        height: 300px;
        object-fit: cover;
    }

    .swiper-pagination-bullet {
        background: rgba(255, 255, 255, 0.5);
        width: 10px;
        height: 10px;
    }

    .swiper-pagination-bullet-active {
        background: rgba(255, 255, 255, 1);
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: rgba(255, 255, 255, 0.8);
    }
</style>

<section class="wrapper-slider">
    <h1 style="position: absolute; left: -9999px;">Game Mobile Studio - Phoenix | Cổng Game Online Hàng Đầu</h1>
    <div class="swiper" id="bannerSwiper">
        <div class="swiper-wrapper">
            @if(isset($bannerGames) && $bannerGames->count() > 0)
                @foreach($bannerGames as $game)
                    <div class="swiper-slide">
                        <a target="_blank" class="item-banner" href="{{ $game->download_link ?? ($game->fanpage_support ?? '#') }}">
                            <img class="banner-image" 
                                 alt="{{ $game->game_name }}" 
                                 src="{{ $game->banner_url ? asset($game->banner_url) : 'https://gamemobilestudio.cloud/images/pattern-bg.png' }}" 
                                 style="width: 100%; height: 300px; object-fit: cover; display: block;">
                        </a>
                    </div>
                @endforeach
            @else
                <div class="swiper-slide">
                    <a target="_blank" class="item-banner" href="#">
                        <img class="banner-image" 
                             alt="Banner" 
                             src="https://gamemobilestudio.cloud/images/pattern-bg.png" 
                             style="width: 100%; height: 300px; object-fit: cover; display: block;">
                    </a>
                </div>
            @endif
        </div>
        <!-- Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Navigation -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
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
