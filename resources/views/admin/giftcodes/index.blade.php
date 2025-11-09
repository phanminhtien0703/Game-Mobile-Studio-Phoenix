@extends('layouts.app')

@section('title', 'Giftcode | Game Mobile Studio')

@push('search-input')
<input
  type="text"
  class="form-control border-0 shadow-none ps-1 ps-sm-2 d-md-block d-none"
  placeholder="Tìm kiếm giftcode..."
  aria-label="Search..." 
  id="searchInput"
  onkeyup="filterGiftcodes()" />
@endpush

@push('styles')
<style>
.giftcode-item {
  display: flex;
  margin-bottom: 1.5rem;
}
.giftcode-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  height: 100%;
  display: flex;
  flex-direction: column;
}
.giftcode-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}
.giftcode-logo {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 8px 8px 0 0;
  flex-shrink: 0;
}
.giftcode-info {
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}
.card-title {
  min-height: 2.5rem;
  display: flex;
  align-items: center;
}
.alert-info {
  min-height: 60px;
  display: flex;
  align-items: center;
}
.quantity-info {
  display: flex;
  justify-content: space-between;
  margin: 1rem 0;
  font-size: 0.9rem;
}
.btn-request-code {
  width: 100%;
  padding: 0.75rem;
  font-size: 1rem;
  font-weight: 600;
  margin-top: auto;
}
.admin-actions {
  margin-top: 0.75rem;
  padding-top: 0.75rem;
  border-top: 1px solid rgba(0,0,0,0.1);
}
</style>
@endpush

@section('content')
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">GIFTCODE</h4>
              </div>

              @if($giftcodes->isEmpty())
                <div class="card">
                  <div class="card-body text-center py-5">
                    <i class="bx bx-gift bx-lg text-muted mb-3"></i>
                    <p class="text-muted">Hiện tại chưa có giftcode nào khả dụng</p>
                  </div>
                </div>
              @else
                <div class="row" id="giftcodeContainer">
                  @foreach($giftcodes as $giftcode)
                    <div class="col-md-6 col-lg-4 giftcode-item" data-game-name="{{ strtolower($giftcode->game->game_name ?? '') }}" data-message="{{ strtolower($giftcode->message) }}">
                      <div class="card giftcode-card">
                        @if($giftcode->logo_game_url)
                          <img src="{{ $giftcode->logo_game_url }}" alt="{{ $giftcode->game->game_name ?? 'Game' }}" class="giftcode-logo" />
                        @else
                          <div class="giftcode-logo bg-label-secondary d-flex align-items-center justify-content-center">
                            <i class="bx bx-game bx-lg"></i>
                          </div>
                        @endif
                        
                        <div class="giftcode-info">
                          <h5 class="card-title mb-2">{{ $giftcode->game->game_name ?? 'Tên game' }}</h5>
                          <div class="alert alert-info mb-3">
                            <small><strong>Tin nhắn:</strong> {{ $giftcode->message }}</small>
                          </div>
                          
                          <div class="quantity-info">
                            <div>
                              <small class="text-muted">Người nhận:</small>
                              <div><strong>{{ $giftcode->used_quantity }} / {{ $giftcode->total_quantity }}</strong></div>
                            </div>
                          </div>

                          <div class="progress mb-3" style="height: 8px;">
                            @php
                              $percentage = $giftcode->usage_percentage;
                              $colorClass = $percentage >= 80 ? 'bg-danger' : ($percentage >= 50 ? 'bg-warning' : 'bg-success');
                            @endphp
                            <div class="progress-bar {{ $colorClass }}" 
                                 role="progressbar" 
                                 data-percentage="{{ $percentage }}"
                                 aria-valuenow="{{ $percentage }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                            </div>
                          </div>

                          <button 
                            class="btn btn-primary btn-request-code request-code-btn"
                            data-game-name="{{ $giftcode->game->game_name ?? 'Game' }}"
                            data-message="{{ $giftcode->message }}"
                            @if($giftcode->remaining_quantity <= 0) disabled @endif>
                            <i class="bx bxl-messenger me-2"></i>
                            @if($giftcode->remaining_quantity <= 0)
                              Đã hết giftcode
                            @else
                              Xin code
                            @endif
                          </button>

                          <div class="admin-actions d-flex gap-2">
                            <a href="{{ route('admin.giftcodes.edit', $giftcode->giftcode_id) }}" class="btn btn-sm btn-warning flex-fill">
                              <i class="bx bx-edit me-1"></i>Sửa
                            </a>
                            <form action="{{ route('admin.giftcodes.destroy', $giftcode->giftcode_id) }}" method="POST" class="flex-fill" onsubmit="return confirm('Bạn có chắc chắn muốn xóa giftcode này?')">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger w-100">
                                <i class="bx bx-trash me-1"></i>Xóa
                              </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endif
            </div>
@endsection

@push('scripts')
<script>
    // Hàm để gửi tin nhắn đến fanpage
    function requestGiftcode(gameName, message) {
        const fanpageId = '1234567890';
        const fullMessage = 'Game: ' + gameName + '\n\n' + message;
        const encodedMessage = encodeURIComponent(fullMessage);
        const messengerUrl = 'https://m.me/' + fanpageId + '?text=' + encodedMessage;
        window.open(messengerUrl, '_blank');
    }

    // Event listener cho các nút xin code và set progress bar width
    document.addEventListener('DOMContentLoaded', function() {
        const progressBars = document.querySelectorAll('.progress-bar');
        progressBars.forEach(bar => {
            const percentage = bar.getAttribute('data-percentage');
            bar.style.width = percentage + '%';
        });

        const requestButtons = document.querySelectorAll('.request-code-btn');
        requestButtons.forEach(button => {
            button.addEventListener('click', function() {
                const gameName = this.getAttribute('data-game-name');
                const message = this.getAttribute('data-message');
                requestGiftcode(gameName, message);
            });
        });
    });

    // Hàm tìm kiếm giftcode với fuzzy matching
    function filterGiftcodes() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase().trim();
        const items = document.getElementsByClassName('giftcode-item');

        if (filter === '') {
            // Hiển thị tất cả nếu không có từ khóa
            for (let i = 0; i < items.length; i++) {
                items[i].style.display = '';
            }
            return;
        }

        for (let i = 0; i < items.length; i++) {
            const gameName = items[i].getAttribute('data-game-name');
            const message = items[i].getAttribute('data-message');
            
            // Tìm kiếm gần giống: kiểm tra xem các ký tự có xuất hiện theo thứ tự
            if (fuzzyMatch(gameName, filter) || fuzzyMatch(message, filter)) {
                items[i].style.display = '';
            } else {
                items[i].style.display = 'none';
            }
        }
    }

    // Hàm fuzzy matching - cho phép tìm kiếm gần giống
    function fuzzyMatch(text, pattern) {
        // Tìm kiếm thông thường trước (nhanh hơn)
        if (text.indexOf(pattern) > -1) {
            return true;
        }

        // Fuzzy search: kiểm tra xem các ký tự của pattern có xuất hiện theo thứ tự trong text không
        let patternIdx = 0;
        let textIdx = 0;
        const patternLen = pattern.length;
        const textLen = text.length;

        while (textIdx < textLen && patternIdx < patternLen) {
            if (text[textIdx] === pattern[patternIdx]) {
                patternIdx++;
            }
            textIdx++;
        }

        return patternIdx === patternLen;
    }
</script>
@endpush
