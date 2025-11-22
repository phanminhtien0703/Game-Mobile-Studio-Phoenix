<div class="d-flex flex-column gap-5 mt-5" style="margin: 0px 12px;">
    <div class="news-in-home">
        <div class="d-flex justify-content-between align-items-center mb-3 text-whited-flex justify-content-between align-items-center mb-3 text-white">
            <h3 class="text-title">LỊCH KHAI MỞ SERVER</h3>
            <a class="d-flex align-items-center gap-2" href="" style="color: rgb(108, 114, 127);">
                <span class="text-navigate" style="cursor: pointer;">Xem tất cả</span>
                <img alt="" src="/icons/arrow.svg">
            </a>
        </div>
        <div class="row">
            @forelse($news as $newsItem)
            <div class="col-sm-6 mb-3">
                <div class="overflow-hidden news-item" 
                     style="cursor: pointer;" 
                     onclick="recordDownload('{{ $newsItem->game_id }}', '{{ $newsItem->download_link }}')">
                    <div class="news-item-image">
                        <img alt="{{ $newsItem->game_name }}"
                            src="{{ $newsItem->banner_url ? asset($newsItem->banner_url) : asset('home/images/loading.png') }}">
                    </div>
                    <div class="news-item-content">
                        <p>{{ $newsItem->description }}</p>
                        <div class="d-flex gap-2 flex-wrap mt-2 justify-content-between align-items-center">
                            <span class="news-item-info">Cập nhật: {{ $newsItem->last_updated ? \Carbon\Carbon::parse($newsItem->last_updated)->format('d-m-Y') : 'N/A' }}</span>
                            <div class="d-flex gap-2 align-items-center">
                                <i class="bx bx-download" style="font-size: 18px; color: #6c727f;"></i>
                                <span class="news-item-info download-count-{{ $newsItem->game_id }}">{{ number_format($newsItem->download_count ?? 0) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-white" style="text-align: center; padding: 20px;">Không có tin tức nào</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<script>
function recordDownload(gameId, downloadUrl) {
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
            // Cập nhật số lượt tải trên giao diện
            const countElement = document.querySelector(`.download-count-${gameId}`);
            if (countElement && data.data.download_count) {
                countElement.textContent = new Intl.NumberFormat('vi-VN').format(data.data.download_count);
            }
            // Chuyển hướng đến link tải
            window.location.href = downloadUrl;
        } else {
            console.error('Error:', data.message);
            // Vẫn chuyển hướng ngay cả khi có lỗi
            window.location.href = downloadUrl;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Vẫn chuyển hướng ngay cả khi có lỗi
        window.location.href = downloadUrl;
    });
}
</script>