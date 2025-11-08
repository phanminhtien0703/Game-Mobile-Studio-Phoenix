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

    <title>Tạo Sự Kiện Giảm Giá Mới | Sneat - Bootstrap Dashboard</title>

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
                          <input type="file" class="form-control @error('banner_url') is-invalid @enderror" id="banner_url" name="banner_url" accept="image/*" onchange="previewImage(event, 'bannerPreview')">
                          <small class="form-text text-muted">Tối đa 5MB (JPEG, PNG, JPG, GIF)</small>
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
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width: 300px; max-height: 150px; border-radius: 4px;">`;
          };
          reader.readAsDataURL(file);
        } else {
          preview.innerHTML = '';
        }
      }
    </script>
  </body>
</html>
