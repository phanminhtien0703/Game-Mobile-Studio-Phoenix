@extends('layouts.admin.app')

@section('title', 'Tạo Giftcode Mới | Game Mobile Studio')

@section('content')
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h5 class="card-title">Tạo Giftcode Mới</h5>
                    </div>
                    <div class="card-body">
                      @if(session('warning'))
                        <div class="alert alert-warning">
                          {{ session('warning') }}
                        </div>
                      @endif

                      @if ($errors->any())
                        <div class="alert alert-danger">
                          <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                      @endif

                      <form action="{{ route('admin.giftcodes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Game Selection -->
                        <div class="mb-3">
                          <label class="form-label" for="game_id">Chọn Game <span class="text-danger">*</span></label>
                          
                          @if(isset($games) && $games->count() > 0)
                            <select class="form-select @error('game_id') is-invalid @enderror" id="game_id" name="game_id" required>
                              <option value="">-- Chọn game (Tổng: {{ $games->count() }} game) --</option>
                              @foreach($games as $game)
                                <option value="{{ $game->game_id }}" 
                                        data-avatar="{{ $game->avatar_url }}"
                                        data-banner="{{ $game->banner_url }}"
                                        {{ old('game_id') == $game->game_id ? 'selected' : '' }}>
                                  {{ $game->game_name }}
                                </option>
                              @endforeach
                            </select>
                          @else
                            <div class="alert alert-warning">
                              <strong>Chưa có game nào trong database!</strong><br>
                              Vui lòng tạo game trước hoặc chạy lệnh: <code>php artisan db:seed --class=GameSeeder</code>
                            </div>
                            <select class="form-select" disabled>
                              <option>Không có game nào</option>
                            </select>
                          @endif
                          
                          @error('game_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Message Content -->
                        <div class="mb-3">
                          <label class="form-label" for="message">Nội dung tin nhắn xin code <span class="text-danger">*</span></label>
                          <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="3" placeholder="VD: Xin chào Admin, tôi muốn nhận giftcode cho game [Tên game]. Cảm ơn Admin!" required>{{ old('message') }}</textarea>
                          <small class="form-text text-muted">Nội dung tin nhắn sẽ được gửi tự động khi người dùng nhấn nút "Xin Code"</small>
                          @error('message')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Total Quantity -->
                        <div class="mb-3">
                          <label class="form-label" for="total_quantity">Tổng Số Lượng <span class="text-danger">*</span></label>
                          <input type="number" class="form-control @error('total_quantity') is-invalid @enderror" id="total_quantity" name="total_quantity" placeholder="VD: 500" value="{{ old('total_quantity', 0) }}" min="1" required>
                          <small class="form-text text-muted">Số lượng giftcode tối đa có thể phát hành</small>
                          @error('total_quantity')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Used Quantity -->
                        <div class="mb-3">
                          <label class="form-label" for="used_quantity">Số Lượng Đã Sử Dụng <span class="text-danger">*</span></label>
                          <input type="number" class="form-control @error('used_quantity') is-invalid @enderror" id="used_quantity" name="used_quantity" placeholder="VD: 0" value="{{ old('used_quantity', 0) }}" min="0" required>
                          <small class="form-text text-muted">Số lượng giftcode đã được sử dụng (thường là 0 khi tạo mới)</small>
                          @error('used_quantity')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Logo Game URL (Hidden - Auto fill from selected game) -->
                        <input type="hidden" id="logo_game_url" name="logo_game_url" value="{{ old('logo_game_url') }}">

                        <!-- Form Actions -->
                        <div class="mb-3">
                          <button type="submit" class="btn btn-primary">
                            <i class="bx bx-plus-circle me-1"></i>
                            Tạo Giftcode
                          </button>
                          <a href="{{ route('admin.giftcodes.index') }}" class="btn btn-secondary">
                            <i class="bx bx-x me-1"></i>
                            Hủy
                          </a>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection

@push('scripts')
<script>
  // Tự động điền logo khi chọn game
  document.getElementById('game_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const avatarUrl = selectedOption.getAttribute('data-avatar');
    const bannerUrl = selectedOption.getAttribute('data-banner');
    const logoInput = document.getElementById('logo_game_url');
    
    // Ưu tiên avatar_url, nếu không có thì dùng banner_url
    const logoUrl = avatarUrl || bannerUrl || '';
    
    if (logoUrl) {
      logoInput.value = logoUrl;
    } else {
      logoInput.value = '';
    }
  });

  // Validation: Số lượng đã sử dụng không được lớn hơn tổng số lượng
  document.getElementById('used_quantity').addEventListener('input', function() {
    const totalQuantity = parseInt(document.getElementById('total_quantity').value) || 0;
    const usedQuantity = parseInt(this.value) || 0;
    
    if (usedQuantity > totalQuantity) {
      this.setCustomValidity('Số lượng đã sử dụng không được lớn hơn tổng số lượng');
    } else {
      this.setCustomValidity('');
    }
  });

  document.getElementById('total_quantity').addEventListener('input', function() {
    const usedQuantity = parseInt(document.getElementById('used_quantity').value) || 0;
    const totalQuantity = parseInt(this.value) || 0;
    
    const usedInput = document.getElementById('used_quantity');
    if (usedQuantity > totalQuantity) {
      usedInput.setCustomValidity('Số lượng đã sử dụng không được lớn hơn tổng số lượng');
    } else {
      usedInput.setCustomValidity('');
    }
  });
</script>
@endpush

