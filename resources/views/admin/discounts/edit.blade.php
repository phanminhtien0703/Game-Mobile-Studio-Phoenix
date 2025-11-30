@extends('layouts.admin.app')

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
                          <input type="file" class="form-control @error('banner_url') is-invalid @enderror" id="banner_url" name="banner_url" accept="image/*">
                          <small class="form-text text-muted">Tối đa 5MB (JPEG, PNG, JPG, GIF). Tự động nén trước upload. Để trống nếu không muốn thay đổi</small>
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
  /**
   * ImageOptimizer - Client-side image compression module
   * Automatically compresses images before upload for optimal web delivery
   * Supports: JPEG, PNG, GIF with canvas-based compression
   */
  const ImageOptimizer = {
    config: {
      maxFileSize: 5 * 1024 * 1024, // 5MB
      maxWidth: 1920,
      maxHeight: 1080,
      quality: 0.75, // 75% JPEG quality for optimal file size
      format: 'image/jpeg'
    },

    /**
     * Validates file type and size
     * @param {File} file - File to validate
     * @returns {Object} - { valid: boolean, error: string }
     */
    validateFile(file) {
      const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
      
      if (!validTypes.includes(file.type)) {
        return { valid: false, error: 'Vui lòng chọn file ảnh hợp lệ (JPEG, PNG, GIF)' };
      }
      
      if (file.size > this.config.maxFileSize) {
        return { valid: false, error: `File quá lớn. Tối đa ${this.config.maxFileSize / 1024 / 1024}MB` };
      }
      
      return { valid: true };
    },

    /**
     * Compresses image using Canvas API
     * @param {File} file - Original file
     * @param {Function} callback - (compressedFile) => {}
     */
    compressImage(file, callback) {
      const reader = new FileReader();
      
      reader.onload = (e) => {
        const img = new Image();
        
        img.onload = () => {
          const canvas = document.createElement('canvas');
          let width = img.width;
          let height = img.height;
          
          // Maintain aspect ratio while fitting within max dimensions
          if (width > height) {
            if (width > this.config.maxWidth) {
              height = Math.round((height * this.config.maxWidth) / width);
              width = this.config.maxWidth;
            }
          } else {
            if (height > this.config.maxHeight) {
              width = Math.round((width * this.config.maxHeight) / height);
              height = this.config.maxHeight;
            }
          }
          
          canvas.width = width;
          canvas.height = height;
          
          const ctx = canvas.getContext('2d');
          ctx.drawImage(img, 0, 0, width, height);
          
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
     * Format bytes to human-readable size (KB, MB)
     * @param {number} bytes - Bytes to format
     * @returns {string} - Formatted size
     */
    formatFileSize(bytes) {
      if (bytes === 0) return '0 Bytes';
      const k = 1024;
      const sizes = ['Bytes', 'KB', 'MB'];
      const i = Math.floor(Math.log(bytes) / Math.log(k));
      return Math.round((bytes / Math.pow(k, i)) * 100) / 100 + ' ' + sizes[i];
    },

    /**
     * Preview image and replace file input with compressed version
     * @param {Event} event - Change event from file input
     * @param {string} previewId - ID of preview container
     */
    previewImage(event, previewId) {
      const input = event.target;
      const file = input.files[0];
      const preview = document.getElementById(previewId);
      
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
      
      const originalSize = file.size;
      
      // Compress image
      this.compressImage(file, (compressedBlob) => {
        const compressedSize = compressedBlob.size;
        const savings = Math.round(((originalSize - compressedSize) / originalSize) * 100);
        
        // Create preview
        const reader = new FileReader();
        reader.onload = (e) => {
          preview.innerHTML = `
            <div style="padding: 10px; background: #f8f9fa; border-radius: 4px; margin-top: 8px;">
              <img src="${e.target.result}" alt="Preview" style="max-width: 300px; max-height: 150px; border-radius: 4px; display: block; margin-bottom: 8px;">
              <small style="color: #6c757d;">
                <strong>Kích thước gốc:</strong> ${this.formatFileSize(originalSize)}<br>
                <strong>Sau nén:</strong> ${this.formatFileSize(compressedSize)}<br>
                <strong>Tiết kiệm:</strong> ${savings}%
              </small>
            </div>
          `;
        };
        reader.readAsDataURL(compressedBlob);
        
        // Replace file input with compressed blob
        const dataTransfer = new DataTransfer();
        const compressedFile = new File([compressedBlob], file.name, { type: 'image/jpeg' });
        dataTransfer.items.add(compressedFile);
        input.files = dataTransfer.files;
      });
    }
  };

  // Initialize event listeners
  document.addEventListener('DOMContentLoaded', function() {
    const bannerInput = document.getElementById('banner_url');
    if (bannerInput) {
      bannerInput.addEventListener('change', (e) => ImageOptimizer.previewImage(e, 'bannerPreview'));
    }
  });
</script>
@endpush

