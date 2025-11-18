<link rel="stylesheet" href="{{ asset('assets/home/next/static/css/89c9f9bed05f369f.css') }}">

<style>
    .promo_item img {
        max-width: 505px;
        max-height: 266px;
        object-fit: cover;
        border-radius: 8px;
        width: 100%;
        height: auto;
        display: block;
    }
    
    .promo_item {
        display: block;
        overflow: hidden;
        border-radius: 8px;
    }
    
    .swiper-button-prev:disabled,
    .swiper-button-next:disabled {
        opacity: 0.3 !important;
        cursor: not-allowed !important;
        pointer-events: none !important;
    }
</style>

<div class="d-flex flex-column gap-5 mt-5" style="margin: 0px 12px;">
    <div class="welfare">
        <div class="d-flex justify-content-between align-items-center mb-3 text-white">
            <h3 class="text-title">SỰ KIỆN</h3>
        </div>
        <div class="list-product-info" style="position: relative;">
            <div class="swiper swiper-initialized swiper-horizontal swiper-backface-hidden" id="promotionSwiper">
                <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms; transition-delay: 0ms;">
                    @forelse($promotions as $promotion)
                    <div class="swiper-slide swiper-slide-active" style="margin-right: 24px;">
                        <a class="promo_item" href="{{ $promotion->event_link ?? '#' }}" target="_blank">
                            <img alt="{{ $promotion->event_name }}" src="{{ $promotion->banner_url ? asset($promotion->banner_url) : asset('home/images/welfare/ho-tro-nap-x4.png') }}">
                        </a>
                    </div>
                    @empty
                    <div class="swiper-slide swiper-slide-active" style="margin-right: 24px;">
                        <a class="promo_item" href="#" target="_blank">
                            <img alt="Không có sự kiện" src="{{ asset('home/images/loading.png') }}">
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
            
            <!-- Navigation Arrows -->
            <button class="swiper-button-prev" style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); z-index: 10; background: rgba(255,255,255,0.5); border: none; padding: 10px 12px; cursor: pointer; border-radius: 4px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <button class="swiper-button-next" style="position: absolute; right: 0; top: 50%; transform: translateY(-50%); z-index: 10; background: rgba(255,255,255,0.5); border: none; padding: 10px 12px; cursor: pointer; border-radius: 4px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const promotionSwiper = new Swiper('#promotionSwiper', {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: false,
            allowTouchMove: false,
            autoplay: false,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
        
        // Hàm cập nhật trạng thái disabled của nút
        const updateNavigationButtons = () => {
            const prevBtn = document.querySelector('.swiper-button-prev');
            const nextBtn = document.querySelector('.swiper-button-next');
            const isFirst = promotionSwiper.isBeginning;
            const isLast = promotionSwiper.isEnd;
            
            if (prevBtn) {
                prevBtn.disabled = isFirst;
            }
            if (nextBtn) {
                nextBtn.disabled = isLast;
            }
        };
        
        // Cập nhật lúc khởi tạo
        updateNavigationButtons();
        
        // Cập nhật khi slide thay đổi
        promotionSwiper.on('slideChange', updateNavigationButtons);
    });
</script>