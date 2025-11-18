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
            <div class="col-sm-6 mb-3" style="cursor: pointer;">
                <div class="overflow-hidden news-item">
                    <div class="news-item-image">
                        <img alt="{{ $newsItem->game_name }}"
                            src="{{ $newsItem->banner_url ? asset($newsItem->banner_url) : asset('home/images/loading.png') }}">
                    </div>
                    <div class="news-item-content">
                        <p>{{ $newsItem->description }}</p>
                        <div class="d-flex gap-2 flex-wrap mt-2 justify-content-end">
                            <!-- <span class="news-item-info">Open: {{ $newsItem->release_date ? \Carbon\Carbon::parse($newsItem->release_date)->format('d-m-Y') : 'N/A' }}</span> -->
                            <span class="news-item-info">Cập nhật: {{ $newsItem->last_updated ? \Carbon\Carbon::parse($newsItem->last_updated)->format('d-m-Y') : 'N/A' }}</span>
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