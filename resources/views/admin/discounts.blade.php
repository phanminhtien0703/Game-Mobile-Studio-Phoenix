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

    <title>Danh sách Sự Kiện Giảm Giá | Sneat - Bootstrap Dashboard</title>

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
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item lh-1 me-4">
                  <a
                    class="github-button"
                    href="https://github.com/themeselection/sneat-bootstrap-html-admin-template-free"
                    data-icon="octicon-star"
                    data-size="large"
                    data-show-count="true"
                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
                    >Star</a
                  >
                </li>

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
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 icon-base bx bx-credit-card icon-md me-3"></i
                          ><span class="flex-grow-1 align-middle">Billing Plan</span>
                          <span class="flex-shrink-0 badge rounded-pill bg-danger">4</span>
                        </span>
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
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">Danh sách sự kiện giảm giá</h5>
                <div class="card-body">
                  <a href="{{ route('admin.discounts.create') }}" class="btn btn-primary btn-sm mb-3">+ Tạo Sự Kiện Mới</a>
                </div>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Banner</th>
                        <th>Tên Sự Kiện</th>
                        <th>Game</th>
                        <th>Thời Gian</th>
                        <th>Trạng Thái</th>
                        <th>Hành Động</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($discounts as $discount)
                      <tr>
                        <td>{{ $discount->discount_id }}</td>
                        <td>
                          @if($discount->banner_url)
                            <img src="{{ $discount->banner_url }}" alt="Banner" class="rounded" style="width: 80px; height: 40px; object-fit: cover;" />
                          @else
                            <span class="text-muted">Không có banner</span>
                          @endif
                        </td>
                        <td>
                          <span>{{ $discount->event_name }}</span>
                        </td>
                        <td>{{ $discount->game ? $discount->game->game_name : 'N/A' }}</td>
                        <td>
                          @if($discount->start_date && $discount->end_date)
                            <small>
                              <strong>Từ:</strong> {{ \Carbon\Carbon::parse($discount->start_date)->format('d/m/Y H:i') }}<br>
                              <strong>Đến:</strong> {{ \Carbon\Carbon::parse($discount->end_date)->format('d/m/Y H:i') }}
                            </small>
                          @else
                            <span class="text-muted">Chưa cập nhật</span>
                          @endif
                        </td>
                        <td>
                          @php
                            $now = now();
                            $status = 'Chưa bắt đầu';
                            $badgeClass = 'bg-label-secondary';
                            
                            if ($discount->start_date && $discount->end_date) {
                              $startDate = \Carbon\Carbon::parse($discount->start_date);
                              $endDate = \Carbon\Carbon::parse($discount->end_date);
                              
                              if ($now->greaterThan($endDate)) {
                                $status = 'Đã kết thúc';
                                $badgeClass = 'bg-label-danger';
                              } elseif ($now->between($startDate, $endDate)) {
                                $status = 'Đang diễn ra';
                                $badgeClass = 'bg-label-success';
                              }
                            }
                          @endphp
                          <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                        </td>
                        <td>
                          <div class="btn-group" role="group">
                            <a href="javascript:void(0);" onclick="showDiscountDetails('{{ $discount->discount_id }}')" class="btn btn-info btn-sm">Xem</a>
                            <a href="{{ route('admin.discounts.edit', $discount->discount_id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('admin.discounts.destroy', $discount->discount_id) }}" method="POST" style="display:inline;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xoá sự kiện này?')">Xoá</button>
                            </form>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Basic Bootstrap Table -->

              <!-- Modal Popup -->
              <div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="discountModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="discountModalLabel">Chi tiết sự kiện</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="discountModalBody">
                      <!-- Nội dung sẽ được cập nhật qua AJAX -->
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

    <div class="buy-now">
      <a
        href="https://themeselection.com/item/sneat-dashboard-pro-bootstrap/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div>

    <!-- Core JS -->

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- Main JS -->

    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
        function showDiscountDetails(discountId) {
            console.log("discount_id = " + discountId);
            // Gửi yêu cầu AJAX để lấy dữ liệu chi tiết discount
            fetch(`/admin/discounts/${discountId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Cập nhật nội dung modal với đầy đủ thông tin
                    document.getElementById('discountModalBody').innerHTML = `
                        <div class="row">
                            <div class="col-md-12">
                                ${data.banner_url ? `<img src="${data.banner_url}" alt="Banner" class="img-fluid rounded mb-3" />` : '<p class="text-muted">Không có banner</p>'}
                            </div>
                            <div class="col-md-12">
                                <h5 class="mb-3">${data.event_name}</h5>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <p><strong>ID Sự Kiện:</strong> ${data.discount_id}</p>
                                        <p><strong>Game:</strong> ${data.game_name}</p>
                                        <p><strong>ID Game:</strong> ${data.game_id}</p>
                                    </div>
                                    <div class="col-6">
                                        <p><strong>Thời gian bắt đầu:</strong> ${data.start_date ? new Date(data.start_date).toLocaleString('vi-VN') : 'Chưa cập nhật'}</p>
                                        <p><strong>Thời gian kết thúc:</strong> ${data.end_date ? new Date(data.end_date).toLocaleString('vi-VN') : 'Chưa cập nhật'}</p>
                                        <p><strong>Ngày tạo:</strong> ${data.created_at ? new Date(data.created_at).toLocaleDateString('vi-VN') : 'Chưa cập nhật'}</p>
                                    </div>
                                </div>
                                <hr />
                                <p><strong>Link sự kiện:</strong></p>
                                ${data.event_link ? `<a href="${data.event_link}" target="_blank" class="btn btn-sm btn-primary">Xem sự kiện</a>` : '<span class="text-muted">Chưa cập nhật</span>'}
                            </div>
                        </div>
                    `;
                    // Hiển thị modal
                    const discountModal = new bootstrap.Modal(document.getElementById('discountModal'));
                    discountModal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Lỗi khi tải dữ liệu sự kiện!');
                });
        }
    </script>
  </body>
</html>
