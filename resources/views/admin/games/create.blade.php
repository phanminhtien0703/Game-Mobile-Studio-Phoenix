<!doctype html>
<html
  lang="en"
  class="layout-menu-fixed layout-compact"
  data-assets-path="{{ asset('assets') }}/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Tạo Game Mới | Sneat - Bootstrap Dashboard</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @include('layouts.dashboard')

        <!-- Layout page -->
        <div class="layout-page">
          <!-- Navbar -->
          <nav
            class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                <i class="icon-base bx bx-menu icon-md"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center me-auto">
                <div class="nav-item d-flex align-items-center">
                  <span class="w-px-22 h-px-22"><i class="icon-base bx bx-search icon-md"></i></span>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none ps-1 ps-sm-2 d-md-block d-none"
                    placeholder="Search..."
                    aria-label="Search..." />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-md-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a
                    class="nav-link dropdown-toggle hide-arrow p-0"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-0">John Doe</h6>
                            <small class="text-body-secondary">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="icon-base bx bx-user icon-md me-3"></i><span>My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="icon-base bx bx-cog icon-md me-3"></i><span>Settings</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">
                        <i class="icon-base bx bx-power-off icon-md me-3"></i><span>Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
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
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                  <div class="mb-2 mb-md-0">
                    &#169;
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , made with ❤️ by Phoenix Team
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

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
  </body>
</html>
