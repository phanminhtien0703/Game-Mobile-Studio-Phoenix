@extends('layouts.app')

@section('title', 'Sửa Sự Kiện Giảm Giá | Game Mobile Studio')

@section('content')
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h5 class="card-title">Sửa Sự Kiện: {{ $discount->event_name }}</h5>
                    </div>
                    <div class="card-body">
                      <form action="{{ route('admin.discounts.update', $discount->discount_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Discount ID (Read-only) -->
                        <div class="mb-3">
                          <label class="form-label" for="discount_id">ID Sự Kiện</label>
                          <input type="text" class="form-control" id="discount_id" value="{{ $discount->discount_id }}" disabled>
                          <small class="form-text text-muted">ID sự kiện không thể thay đổi</small>
                        </div>

                        <!-- Game -->
                        <div class="mb-3">
                          <label class="form-label" for="game_id">Game <span class="text-danger">*</span></label>
                          <select class="form-select @error('game_id') is-invalid @enderror" id="game_id" name="game_id" required>
                            <option value="">-- Chọn game --</option>
                            @foreach($games as $game)
                              <option value="{{ $game->game_id }}" {{ old('game_id', $discount->game_id) == $game->game_id ? 'selected' : '' }}>
                                {{ $game->game_name }}
                              </option>
                            @endforeach
                          </select>
                          @error('game_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Event Name -->
                        <div class="mb-3">
                          <label class="form-label" for="event_name">Tên Sự Kiện <span class="text-danger">*</span></label>
                          <input type="text" class="form-control @error('event_name') is-invalid @enderror" id="event_name" name="event_name" placeholder="VD: Tết Event 2025, Summer Sale" value="{{ old('event_name', $discount->event_name) }}" required>
                          @error('event_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Start Date -->
                        <div class="mb-3">
                          <label class="form-label" for="start_date">Thời Gian Bắt Đầu <span class="text-danger">*</span></label>
                          <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', $discount->start_date ? \Carbon\Carbon::parse($discount->start_date)->format('Y-m-d\TH:i') : '') }}" required>
                          @error('start_date')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- End Date -->
                        <div class="mb-3">
                          <label class="form-label" for="end_date">Thời Gian Kết Thúc <span class="text-danger">*</span></label>
                          <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', $discount->end_date ? \Carbon\Carbon::parse($discount->end_date)->format('Y-m-d\TH:i') : '') }}" required>
                          @error('end_date')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Banner URL -->
                        <div class="mb-3">
                          <label class="form-label" for="banner_url">Banner</label>
                          <input type="file" class="form-control @error('banner_url') is-invalid @enderror" id="banner_url" name="banner_url" accept="image/*" onchange="previewImage(event, 'bannerPreview')">
                          <small class="form-text text-muted">Tối đa 5MB (JPEG, PNG, JPG, GIF). Để trống nếu không muốn thay đổi</small>
                          @if($discount->banner_url)
                            <div class="mt-2">
                              <small class="form-text text-muted">Banner hiện tại:</small><br>
                              <img src="{{ $discount->banner_url }}" alt="Banner" style="max-width: 300px; max-height: 150px; border-radius: 4px;">
                            </div>
                          @endif
                          <div id="bannerPreview" class="mt-2"></div>
                          @error('banner_url')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Event Link -->
                        <div class="mb-3">
                          <label class="form-label" for="event_link">Link Sự Kiện</label>
                          <input type="url" class="form-control @error('event_link') is-invalid @enderror" id="event_link" name="event_link" placeholder="Nhập link chi tiết sự kiện" value="{{ old('event_link', $discount->event_link) }}">
                          @error('event_link')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="mb-3">
                          <button type="submit" class="btn btn-primary">Cập Nhật Sự Kiện</button>
                          <a href="{{ route('admin.discounts.index') }}" class="btn btn-secondary">Hủy</a>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
@endsection

@push('scripts')
<script>
  function previewImage(event, previewId) {
    const file = event.target.files[0];
    const preview = document.getElementById(previewId);
    
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width: 300px; max-height: 150px; border-radius: 4px;">`;
      };
      reader.readAsDataURL(file);
    } else {
      preview.innerHTML = '';
    }
  }
</script>
@endpush
