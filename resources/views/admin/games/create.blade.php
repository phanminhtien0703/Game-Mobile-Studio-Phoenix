@extends('layouts.admin.app')

@section('title', 'Tạo Game Mới | Game Mobile Studio')

@section('content')
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h5 class="card-title">Tạo Game Mới</h5>
                    </div>
                    <div class="card-body">
                      <form action="{{ route('admin.games.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Game ID -->
                        <div class="mb-3">
                          <label class="form-label" for="game_id">ID Game <span class="text-danger">*</span></label>
                          <input type="text" class="form-control @error('game_id') is-invalid @enderror" id="game_id" name="game_id" placeholder="Nhập ID game (VD: than_ma_giang_the)" value="{{ old('game_id') }}" required>
                          @error('game_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Game Name -->
                        <div class="mb-3">
                          <label class="form-label" for="game_name">Tên Game <span class="text-danger">*</span></label>
                          <input type="text" class="form-control @error('game_name') is-invalid @enderror" id="game_name" name="game_name" placeholder="Nhập tên game" value="{{ old('game_name') }}" required>
                          @error('game_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Genre -->
                        <div class="mb-3">
                          <label class="form-label" for="genre">Thể Loại <span class="text-danger">*</span></label>
                          <input type="text" class="form-control @error('genre') is-invalid @enderror" id="genre" name="genre" placeholder="VD: MMO, Action, RPG" value="{{ old('genre') }}" required>
                          @error('genre')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                          <label class="form-label" for="description">Mô Tả <span class="text-danger">*</span></label>
                          <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Nhập mô tả chi tiết về game" required>{{ old('description') }}</textarea>
                          @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Release Date -->
                        <div class="mb-3">
                          <label class="form-label" for="release_date">Ngày Phát Hành <span class="text-danger">*</span></label>
                          <input type="date" class="form-control @error('release_date') is-invalid @enderror" id="release_date" name="release_date" value="{{ old('release_date') }}" required>
                          @error('release_date')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Avatar URL -->
                        <div class="mb-3">
                          <label class="form-label" for="avatar_url">Avatar <span class="text-danger">*</span></label>
                          <input type="file" class="form-control @error('avatar_url') is-invalid @enderror" id="avatar_url" name="avatar_url" accept="image/*" onchange="previewImage(event, 'avatarPreview')">
                          <small class="form-text text-muted">Tối đa 2MB (JPEG, PNG, JPG, GIF)</small>
                          <div id="avatarPreview" class="mt-2"></div>
                          @error('avatar_url')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Banner URL -->
                        <div class="mb-3">
                          <label class="form-label" for="banner_url">Banner</label>
                          <input type="file" class="form-control @error('banner_url') is-invalid @enderror" id="banner_url" name="banner_url" accept="image/*" onchange="previewImage(event, 'bannerPreview')">
                          <small class="form-text text-muted">Tối đa 5MB (JPEG, PNG, JPG, GIF)</small>
                          <div id="bannerPreview" class="mt-2"></div>
                          @error('banner_url')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Download Link -->
                        <div class="mb-3">
                          <label class="form-label" for="download_link">Link Tải Xuống</label>
                          <input type="url" class="form-control @error('download_link') is-invalid @enderror" id="download_link" name="download_link" placeholder="Nhập link tải xuống game" value="{{ old('download_link') }}">
                          @error('download_link')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Status ID -->
                        <div class="mb-3">
                          <label class="form-label" for="status_id">Trạng Thái <span class="text-danger">*</span></label>
                          <select class="form-select @error('status_id') is-invalid @enderror" id="status_id" name="status_id" required>
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="game_hot" {{ old('status_id') == 'game_hot' ? 'selected' : '' }}>Game Hot</option>
                            <option value="game_new" {{ old('status_id') == 'game_new' ? 'selected' : '' }}>Game Mới</option>
                            <option value="game_coming_soon" {{ old('status_id') == 'game_coming_soon' ? 'selected' : '' }}>Sắp Phát Hành</option>
                            <option value="game_offline" {{ old('status_id') == 'game_offline' ? 'selected' : '' }}>Ngừng Hoạt Động</option>
                          </select>
                          @error('status_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Sort Order -->
                        <div class="mb-3">
                          <label class="form-label" for="sort_order">Thứ Tự Sắp Xếp</label>
                          <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" placeholder="Nhập thứ tự sắp xếp (số nguyên)" value="{{ old('sort_order') }}">
                          <small class="form-text text-muted">Giá trị nhỏ hơn = vị trí cao hơn trong danh sách</small>
                          @error('sort_order')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Download Count (Read Only) -->
                        <div class="mb-3">
                          <label class="form-label" for="download_count">Lượt Tải</label>
                          <input type="number" class="form-control @error('download_count') is-invalid @enderror" id="download_count" name="download_count" placeholder="Nhập lượt tải (mặc định: 0)" value="{{ old('download_count', 0) }}">
                          <small class="form-text text-muted">Có thể thay đổi thủ công hoặc được cập nhật tự động khi người dùng tải game</small>
                          @error('download_count')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="mb-3">
                          <button type="submit" class="btn btn-primary">Tạo Game</button>
                          <a href="{{ route('admin.games.index') }}" class="btn btn-secondary">Hủy</a>
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
        preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 4px;">`;
      };
      reader.readAsDataURL(file);
    } else {
      preview.innerHTML = '';
    }
  }
</script>
@endpush

