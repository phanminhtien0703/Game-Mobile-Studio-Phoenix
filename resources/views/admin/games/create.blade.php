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
                          <input type="file" class="form-control @error('avatar_url') is-invalid @enderror" id="avatar_url" name="avatar_url" accept="image/*" required>
                          <small class="form-text text-muted">Tối đa 2MB (JPEG, PNG, JPG, GIF) - Tự động nén trước upload</small>
                          <div id="avatarPreview" class="mt-2"></div>
                          @error('avatar_url')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Banner URL -->
                        <div class="mb-3">
                          <label class="form-label" for="banner_url">Banner</label>
                          <input type="file" class="form-control @error('banner_url') is-invalid @enderror" id="banner_url" name="banner_url" accept="image/*">
                          <small class="form-text text-muted">Tối đa 5MB (JPEG, PNG, JPG, GIF) - Tự động nén trước upload</small>
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

                        <!-- Fanpage Support -->
                        <div class="mb-3">
                          <label class="form-label" for="fanpage_support">Fanpage / Messenger Hỗ Trợ</label>
                          <input type="text" class="form-control @error('fanpage_support') is-invalid @enderror" id="fanpage_support" name="fanpage_support" placeholder="Nhập URL Facebook fanpage hoặc Messenger (VD: https://www.facebook.com/...)" value="{{ old('fanpage_support') }}">
                          <small class="form-text text-muted">Tùy chọn: Liên kết hỗ trợ trên Facebook Fanpage hoặc Messenger</small>
                          @error('fanpage_support')
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
  /**
   * Image Optimization Manager
   * Handles image preview, compression, and optimization
   */
  const ImageOptimizer = {
    // Configuration
    config: {
      maxFileSize: 5 * 1024 * 1024, // 5MB
      maxWidth: 1920,
      maxHeight: 1080,
      quality: 0.75,
      format: 'image/jpeg',
      previewMaxWidth: 200,
      previewMaxHeight: 200
    },

    /**
     * Validate file
     * @param {File} file - File to validate
     * @returns {Object} Validation result
     */
    validateFile(file) {
      if (!file.type.startsWith('image/')) {
        return { valid: false, error: 'File phải là ảnh' };
      }

      if (file.size > this.config.maxFileSize) {
        const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
        return { valid: false, error: `Ảnh quá lớn (${sizeMB}MB). Tối đa 5MB` };
      }

      return { valid: true };
    },

    /**
     * Compress image using Canvas API
     * @param {File} file - Original image file
     * @param {Function} callback - Callback with compressed blob
     */
    compressImage(file, callback) {
      const reader = new FileReader();
      
      reader.onload = (e) => {
        const img = new Image();
        
        img.onload = () => {
          const canvas = document.createElement('canvas');
          let width = img.width;
          let height = img.height;

          // Calculate new dimensions (maintain aspect ratio)
          if (width > this.config.maxWidth || height > this.config.maxHeight) {
            const ratio = Math.min(
              this.config.maxWidth / width,
              this.config.maxHeight / height
            );
            width = Math.round(width * ratio);
            height = Math.round(height * ratio);
          }

          canvas.width = width;
          canvas.height = height;

          const ctx = canvas.getContext('2d');
          ctx.drawImage(img, 0, 0, width, height);

          // Convert to blob with compression
          canvas.toBlob(
            (blob) => callback(blob),
            this.config.format,
            this.config.quality
          );
        };

        img.src = e.target.result;
      };

      reader.readAsDataURL(file);
    },

    /**
     * Format file size for display
     * @param {number} bytes - Size in bytes
     * @returns {string} Formatted size
     */
    formatFileSize(bytes) {
      if (bytes === 0) return '0 Bytes';
      const k = 1024;
      const sizes = ['Bytes', 'KB', 'MB'];
      const i = Math.floor(Math.log(bytes) / Math.log(k));
      return Math.round((bytes / Math.pow(k, i)) * 100) / 100 + ' ' + sizes[i];
    },

    /**
     * Preview image
     * @param {Event} event - Input change event
     * @param {string} previewId - Preview container ID
     */
    previewImage(event, previewId) {
      const file = event.target.files[0];
      const preview = document.getElementById(previewId);
      const input = event.target;

      if (!file) {
        preview.innerHTML = '';
        return;
      }

      // Validate file
      const validation = this.validateFile(file);
      if (!validation.valid) {
        alert(validation.error);
        input.value = '';
        preview.innerHTML = '';
        return;
      }

      // Show original size
      const originalSize = this.formatFileSize(file.size);
      preview.innerHTML = `<div style="color: #999; font-size: 12px;">Đang xử lý... (kích thước gốc: ${originalSize})</div>`;

      // Compress image
      this.compressImage(file, (compressedBlob) => {
        const compressedSize = this.formatFileSize(compressedBlob.size);
        const ratio = ((1 - compressedBlob.size / file.size) * 100).toFixed(0);

        // Create preview
        const reader = new FileReader();
        reader.onload = (e) => {
          preview.innerHTML = `
            <div style="margin-top: 10px;">
              <img src="${e.target.result}" alt="Preview" style="max-width: ${this.config.previewMaxWidth}px; max-height: ${this.config.previewMaxHeight}px; border-radius: 4px; display: block; margin-bottom: 8px;">
              <small style="color: #28a745; font-weight: bold;">✓ Nén thành công</small><br>
              <small style="color: #666;">Kích thước gốc: ${originalSize} → ${compressedSize} (tiết kiệm ${ratio}%)</small>
            </div>
          `;
        };
        reader.readAsDataURL(compressedBlob);

        // Replace file input with compressed blob
        const dataTransfer = new DataTransfer();
        const compressedFile = new File([compressedBlob], file.name, { 
          type: this.config.format,
          lastModified: Date.now()
        });
        dataTransfer.items.add(compressedFile);
        input.files = dataTransfer.files;
      });
    }
  };

  // Initialize on page load
  document.addEventListener('DOMContentLoaded', function() {
    const avatarInput = document.getElementById('avatar_url');
    const bannerInput = document.getElementById('banner_url');

    if (avatarInput) {
      avatarInput.addEventListener('change', function(e) {
        ImageOptimizer.previewImage(e, 'avatarPreview');
      });
    }

    if (bannerInput) {
      bannerInput.addEventListener('change', function(e) {
        ImageOptimizer.previewImage(e, 'bannerPreview');
      });
    }
  });
</script>
@endpush

