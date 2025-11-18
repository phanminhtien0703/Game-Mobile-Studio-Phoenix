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
</style>

<section class="wrapper-slider" data-games="{{ base64_encode(serialize($bannerGames ?? [])) }}">
    <div class="swiper" id="bannerSwiper">
        <div class="swiper-wrapper">
            @forelse($bannerGames as $game)
                <div class="swiper-slide">
                    <a target="_blank" class="item-banner" href="">
                        <img class="object-fit-cover h-100 w-100 banner-image" alt="{{ $game->game_name }}" src="{{ $game->banner_url ? asset($game->banner_url) : asset('assets/home/images/pattern-bg.png') }}" style="width: 100%; height: 300px; object-fit: cover;" data-url="{{ $game->banner_url }}" data-name="{{ $game->game_name }}">
                    </a>
                </div>
            @empty
                <div class="swiper-slide">
                    <a target="_blank" class="item-banner" href="">
                        <img class="object-fit-cover h-100 w-100 banner-image" alt="Banner" src="https://gamemobilestudio.cloud/images/pattern-bg.png" style="width: 100%; height: 300px; object-fit: cover;" data-url="" data-name="Banner">
                    </a>
                </div>
            @endforelse
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
    const sliderSection = document.querySelector('.wrapper-slider');
    const allImages = document.querySelectorAll('.banner-image');
    const swiperWrapper = document.querySelector('.swiper-wrapper');
    let currentIndex = 0;
    
    // Hàm cập nhật banner
    function updateBanner() {
        if (allImages.length === 0) return;
        
        const currentImg = allImages[currentIndex];
        const bannerUrl = currentImg.getAttribute('data-url');
        const gameName = currentImg.getAttribute('data-name');
        
        let imgUrl;
        if (bannerUrl) {
            const basePath = '{{ asset("") }}';
            imgUrl = basePath + bannerUrl;
        } else {
            imgUrl = 'https://gamemobilestudio.cloud/images/pattern-bg.png';
        }
        
        // Cập nhật tất cả img trong carousel
        allImages.forEach(img => {
            img.src = imgUrl;
            img.alt = gameName || 'Banner';
        });
        
        // Chuyển sang game tiếp theo
        currentIndex = (currentIndex + 1) % allImages.length;
    }
    
    // Cập nhật banner lần đầu
    updateBanner();
    
    // Tự động cập nhật mỗi 5 giây
    setInterval(updateBanner, 5000);
    
    // Khởi tạo Swiper
    const swiper = new Swiper('#bannerSwiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 5000,
        },
    });
});
</script>
