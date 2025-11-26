@extends('layouts.admin.app')

@section('title', 'Danh sách Sự Kiện Giảm Giá | Game Mobile Studio')

@push('search-input')
<input
  type="text"
  id="searchDiscountInput"
  class="form-control border-0 shadow-none ps-1 ps-sm-2 d-md-block d-none"
  placeholder="Tìm kiếm sự kiện..."
  aria-label="Search..." />
@endpush

@section('content')
  <!-- Basic Bootstrap Table -->
  <div class="card">
    <h5 class="card-header">Danh sách sự kiện giảm giá</h5>
    <div class="card-body">
      <a href="{{ route('admin.discounts.create') }}" class="btn btn-primary btn-sm mb-3">+ Tạo Sự Kiện Mới</a>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr class="text-center">
            <th>ID</th>
            <th>Banner</th>
            <th>Tên Sự Kiện</th>
            <th>Game</th>
            <th>Thời Gian</th>
            <th>Trạng Thái</th>
            <th>Hành Động</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0 text-center">
          @forelse($discounts as $discount)
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
              <a href="javascript:void(0);" onclick="showDiscountDetails('{{ $discount->discount_id }}')" class="btn btn-info btn-sm" title="Xem chi tiết">
                <i class="bx bx-show"></i>
              </a>
              <a href="{{ route('admin.discounts.edit', $discount->discount_id) }}" class="btn btn-warning btn-sm" title="Chỉnh sửa">
                <i class="bx bx-edit"></i>
              </a>
              <form action="{{ route('admin.discounts.destroy', $discount->discount_id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" title="Xóa" onclick="return confirm('Bạn chắc chứ?')">
                  <i class="bx bx-trash"></i>
                </button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center py-4">
              <div class="text-muted">
                <i class="bx bx-info-circle bx-sm mb-2"></i>
                <p class="mb-0">Chưa có sự kiện giảm giá nào.</p>
                <a href="{{ route('admin.discounts.create') }}" class="btn btn-sm btn-primary mt-2">
                  <i class="bx bx-plus me-1"></i>Tạo sự kiện đầu tiên
                </a>
              </div>
            </td>
          </tr>
          @endforelse
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
@endsection

@push('scripts')
<script>
    // Fuzzy search function
    function fuzzyMatch(str, pattern) {
        pattern = pattern.toLowerCase();
        str = str.toLowerCase();
        
        let patternIdx = 0;
        let strIdx = 0;
        
        while (strIdx < str.length && patternIdx < pattern.length) {
            if (str[strIdx] === pattern[patternIdx]) {
                patternIdx++;
            }
            strIdx++;
        }
        
        return patternIdx === pattern.length;
    }

    // Search functionality
    document.getElementById('searchDiscountInput').addEventListener('keyup', function() {
        const searchText = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('tbody tr');
        
        tableRows.forEach(function(row) {
            // Skip empty state row
            if (row.querySelector('td[colspan]')) {
                return;
            }
            
            const discountId = row.cells[0].textContent;
            const discountName = row.cells[2].textContent;
            const gameName = row.cells[3].textContent;
            
            const searchableText = discountId + ' ' + discountName + ' ' + gameName;
            
            if (fuzzyMatch(searchableText, searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    function showDiscountDetails(discountId) {
        console.log("discount_id = " + discountId);
        fetch(`/admin/discounts/${discountId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
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
                const discountModal = new bootstrap.Modal(document.getElementById('discountModal'));
                discountModal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Lỗi khi tải dữ liệu sự kiện!');
            });
    }
</script>
@endpush
