<div class="d-flex flex-column gap-5 mt-5" style="margin: 0px 12px;">
    <div class="giftcode_list">
        <div class="d-flex justify-content-between align-items-center mb-3 text-white">
            <h3 class="text-title">GIFTCODE</h3>
            <a class="d-flex align-items-center gap-2" href="" style="color: rgb(108, 114, 127);">
                <span class="text-navigate" style="cursor: pointer;">Xem tất cả</span>
                <img alt="" src="/icons/arrow.svg">
            </a>
        </div>
        <div class="row">
            @forelse($giftcodes as $giftcode)
            <div class="col-12 col-sm-6">
                <a class="item d-flex" href="#">
                    <div class="img">
                        <img alt="{{ $giftcode->game->game_name ?? 'Giftcode' }}" 
                             src="{{ $giftcode->game->avatar_url ? asset($giftcode->game->avatar_url) : asset('home/images/loading.png') }}">
                    </div>
                    <div class="detail">
                        <h2>{{ $giftcode->game->game_name ?? 'Không có tên' }}</h2>
                        <p>Giftcode: {{ $giftcode->total_quantity }}</p>
                        <p>Người nhận: {{ $giftcode->used_quantity }}</p>
                        <button class="btn giftcode-btn" 
                                data-giftcode-id="{{ $giftcode->giftcode_id }}" 
                                data-message="{{ $giftcode->message }}" 
                                type="button">Nhận code</button>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12">
                <p class="text-white" style="text-align: center; padding: 20px;">Không có giftcode nào</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const giftcodeBtns = document.querySelectorAll('.giftcode-btn');
        const page = '{{ config("social.messenger.page_id") }}'; // Lấy từ config

        giftcodeBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const giftcodeId = this.getAttribute('data-giftcode-id');
                const msg = this.getAttribute('data-message');
                
                // Gửi AJAX request để cập nhật số lượng giftcode đã nhận
                fetch(`/admin/giftcodes/${giftcodeId}/claim`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Cập nhật số lượng đã nhận trên UI
                        const detailDiv = this.closest('.item').querySelector('.detail');
                        const usedQuantityText = detailDiv.querySelectorAll('p')[1];
                        usedQuantityText.textContent = `Người nhận: ${data.used_quantity}`;
                        
                        // Mở Messenger
                        const messengerUrl = `https://m.me/${page}?text=${encodeURIComponent(msg)}`;
                        window.open(messengerUrl, '_blank');
                    } else {
                        alert(data.message || 'Lỗi khi nhận giftcode');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Lỗi khi nhận giftcode');
                });
            });
        });
    });
</script>