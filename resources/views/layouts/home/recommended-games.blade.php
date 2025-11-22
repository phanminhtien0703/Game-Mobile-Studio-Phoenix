<style>
    @keyframes blink {
        0%, 50%, 100% {
            opacity: 1;
        }
        25%, 75% {
            opacity: 0.3;
        }
    }

    .game-item-hot {
        position: absolute;
        top: 8px;
        right: 8px;
        background: linear-gradient(135deg, #FF6B6B 0%, #FF4757 100%);
        color: white;
        padding: 2px 4px;
        border-radius: 4px;
        font-size: 8px;
        font-weight: bold;
        animation: blink 2.5s ease-in-out infinite;
        z-index: 10;
    }

    .game-item {
        position: relative;
    }
</style>

<div class="d-flex flex-column gap-5 mt-5" style="margin: 0px 12px;">
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3 text-white">
            <h3 class="text-title">GAME ĐỀ XUẤT</h3>
            <a class="d-flex align-items-center gap-2" href="/games" style="color: rgb(108, 114, 127);"></a>
        </div>
        <div class="product_list">
            @forelse($recommendedGames as $game)
            <a class="item game-item" href="javascript:void(0);" onclick="recordGameDownload('{{ $game->game_id }}', '{{ $game->download_link }}')">
                <div class="game-item-hot">HOT</div>
                <div class="img"><img alt="{{ $game->game_name }}" src="{{ $game->avatar_url ? asset($game->avatar_url) : asset('home/images/loading.png') }}"></div>
                <div class="desc">
                    <h3 class="text-cover title-product ">{{ $game->game_name }}</h3>
                    <p>{{ $game->genre ?? 'Game' }}</p>
                </div>
            </a>
            @empty
            <a class="item " href="#">
                <div class="img"><img alt="" src="{{ asset('home/images/loading.png') }}"></div>
                <div class="desc">
                    <h3 class="text-cover title-product ">Loading....</h3>
                    <p>Loading....</p>
                </div>
            </a>
            @endforelse
        </div>
        <div class="view_more"><span class="left"></span><span class="center">Thu gọn <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
                    <path d="M9 5.30029L5 1.30029L1 5.30029" stroke="#6C727F"></path>
                </svg></span><span class="right"></span></div>
    </div>
</div>

<script>
function recordGameDownload(gameId, downloadLink) {
    // Gửi request đến API để ghi nhận lượt tải
    fetch(`/api/games/${gameId}/download`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Chuyển hướng đến download link
            window.location.href = downloadLink;
        } else {
            console.error('Error:', data.message);
            // Vẫn chuyển hướng ngay cả khi có lỗi
            window.location.href = downloadLink;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Vẫn chuyển hướng ngay cả khi có lỗi
        window.location.href = downloadLink;
    });
}
</script>
