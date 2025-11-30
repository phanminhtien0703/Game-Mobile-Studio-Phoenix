@extends('layouts.admin.app')

@section('title', 'Tạo Sự Kiện Giảm Giá Mới | Game Mobile Studio')

@section('content')
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h5 class="card-title">Tạo Sự Kiện Giảm Giá Mới</h5>
                    </div>
                    <div class="card-body">
                      <form action="{{ route('admin.discounts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Game -->
                        <div class="mb-3">
                          <label class="form-label" for="game_id">Game <span class="text-danger">*</span></label>
                          <select class="form-select @error('game_id') is-invalid @enderror" id="game_id" name="game_id" required>
                            <option value="">-- Chọn game --</option>
                            @foreach($games as $game)
                              <option value="{{ $game->game_id }}" {{ old('game_id') == $game->game_id ? 'selected' : '' }}>
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
                          <input type="text" class="form-control @error('event_name') is-invalid @enderror" id="event_name" name="event_name" placeholder="VD: Tết Event 2025, Summer Sale" value="{{ old('event_name') }}" required>
                          @error('event_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Start Date -->
                        <div class="mb-3">
                          <label class="form-label" for="start_date">Thời Gian Bắt Đầu <span class="text-danger">*</span></label>
                          <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                          @error('start_date')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- End Date -->
                        <div class="mb-3">
                          <label class="form-label" for="end_date">Thời Gian Kết Thúc <span class="text-danger">*</span></label>
                          <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                          @error('end_date')
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

                        <!-- Event Link -->
                        <div class="mb-3">
                          <label class="form-label" for="event_link">Link Sự Kiện</label>
                          <input type="url" class="form-control @error('event_link') is-invalid @enderror" id="event_link" name="event_link" placeholder="Nhập link chi tiết sự kiện" value="{{ old('event_link') }}">
                          @error('event_link')
                            <span class="invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="mb-3">
                          <button type="submit" class="btn btn-primary">Tạo Sự Kiện</button>
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
      previewMaxWidth: 300,
      previewMaxHeight: 150
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
    const bannerInput = document.getElementById('banner_url');

    if (bannerInput) {
      bannerInput.addEventListener('change', function(e) {
        ImageOptimizer.previewImage(e, 'bannerPreview');
      });
    }
  });
</script>
@endpush

