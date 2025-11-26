@extends('layouts.admin.app')

@section('title', 'Quản Lý Tài Khoản Bán | Game Mobile Studio')

@push('search-input')
<input
  type="text"
  id="searchShopInput"
  class="form-control border-0 shadow-none ps-1 ps-sm-2 d-md-block d-none"
  placeholder="Tìm kiếm tài khoản..."
  aria-label="Search..." />
@endpush

@section('content')
  <!-- Basic Bootstrap Table -->
  <div class="card">
    <h5 class="card-header">Quản Lý Tài Khoản Bán</h5>
    <div class="card-body">
      <a href="{{ route('admin.shops.create') }}" class="btn btn-primary btn-sm mb-3">+ Thêm Tài Khoản</a>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th class="text-center">Tên Nhân Vật</th>
            <th class="text-center">Trò Chơi</th>
            <th class="text-center">Server</th>
            <th class="text-center">Người Bán</th>
            <th class="text-center">Giá</th>
            <th class="text-center">Trạng Thái</th>
            <th class="text-center">Lượt Xem</th>
            <th class="text-center">Ngày Tạo</th>
            <th class="text-center">Hành Động</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($accounts as $account)
          <tr>
            <td class="text-center">{{ Str::limit($account->character_name, 30) }}</td>
            <td class="text-center">{{ $account->game->game_name ?? 'N/A' }}</td>
            <td class="text-center">{{ $account->server_name }}</td>
            <td class="text-center">{{ $account->user->username ?? 'N/A' }}</td>
            <td class="text-center">
              <span>{{ number_format($account->price, 0, ',', ',') }} đ</span>
            </td>
            <td class="text-center">
              <span class="badge 
                {{ $account->status === 'approved' ? 'bg-success' : 
                   ($account->status === 'pending' ? 'bg-warning' : 
                   ($account->status === 'sold' ? 'bg-secondary' : 'bg-danger')) }}">
                {{ ucfirst($account->status) }}
              </span>
            </td>
            <td class="text-center">
              <span>{{ $account->views ?? 0 }}</span>
            </td>
            <td class="text-center">{{ $account->created_at ? (is_string($account->created_at) ? \Carbon\Carbon::parse($account->created_at)->format('d/m/Y H:i') : $account->created_at->format('d/m/Y H:i')) : 'N/A' }}</td>
            <td class="text-center">
              <a href="javascript:void(0);" onclick="showAccountDetails('{{ $account->id }}')" class="btn btn-info btn-sm" title="Xem chi tiết">
                <i class="bx bx-show"></i>
              </a>
              <a href="{{ route('admin.shops.edit', $account->id) }}" class="btn btn-warning btn-sm" title="Chỉnh sửa">
                <i class="bx bx-edit"></i>
              </a>
              <form action="{{ route('admin.shops.destroy', $account->id) }}" method="POST" style="display:inline;">
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
            <td colspan="9" class="text-center py-4">
              <div class="text-muted">
                <i class="bx bx-info-circle bx-sm mb-2"></i>
                <p class="mb-0">Chưa có tài khoản nào.</p>
                <a href="{{ route('admin.shops.create') }}" class="btn btn-sm btn-primary mt-2">
                  <i class="bx bx-plus me-1"></i>Tạo tài khoản đầu tiên
                </a>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if($accounts->count() > 0)
    <div class="card-footer">
      {{ $accounts->links() }}
    </div>
    @endif
  </div>
  <!--/ Basic Bootstrap Table -->

  <!-- Modal Popup -->
  <div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="accountModalLabel">Chi tiết tài khoản</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="accountModalBody">
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
    document.getElementById('searchShopInput').addEventListener('keyup', function() {
        const searchText = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('tbody tr');
        
        tableRows.forEach(function(row) {
            // Skip empty state row
            if (row.querySelector('td[colspan]')) {
                return;
            }
            
            const characterName = row.cells[0].textContent;
            const gameName = row.cells[1].textContent;
            const server = row.cells[2].textContent;
            const seller = row.cells[3].textContent;
            
            const searchableText = characterName + ' ' + gameName + ' ' + server + ' ' + seller;
            
            if (fuzzyMatch(searchableText, searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    function showAccountDetails(accountId) {
        console.log("account_id = " + accountId);
        // Gửi yêu cầu AJAX để lấy dữ liệu chi tiết tài khoản
        fetch(`/admin/shops/${accountId}/json`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Cập nhật nội dung modal với đầy đủ thông tin
                let imagesHtml = '';
                if (data.images && data.images.length > 0) {
                    imagesHtml = '<div class="mb-3"><strong>Hình ảnh:</strong><br>';
                    data.images.forEach(image => {
                        imagesHtml += `<img src="${image}" alt="Account Image" class="img-fluid rounded me-2 mb-2" style="max-width: 100px; max-height: 100px;" />`;
                    });
                    imagesHtml += '</div>';
                }

                document.getElementById('accountModalBody').innerHTML = `
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="mb-3 text-center"><strong>Tên nhân vật:</strong> ${data.character_name}</h5>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <p><strong>ID:</strong> ${data.id}</p>
                                    <p><strong>Trò Chơi:</strong> ${data.game_name || 'Chưa cập nhật'}</p>
                                    <p><strong>Server:</strong> ${data.server_name || 'Chưa cập nhật'}</p>
                                </div>
                                <div class="col-6">
                                    <p><strong>Người Bán:</strong> ${data.seller_username || 'Chưa cập nhật'}</p>
                                    <p><strong>Giá:</strong> <span>${data.price ? new Intl.NumberFormat('vi-VN').format(data.price) + ' đ' : '0 đ'}</span></p>
                                    <p><strong>Trạng Thái:</strong> <span class="badge ${data.status === 'approved' ? 'bg-success' : (data.status === 'pending' ? 'bg-warning' : (data.status === 'sold' ? 'bg-secondary' : 'bg-danger'))}">${data.status}</span></p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <p><strong>Lượt Xem:</strong> <span>${data.views || 0}</span></p>
                                </div>
                                <div class="col-6">
                                    <p><strong>Ngày Tạo:</strong> ${data.created_at || 'Chưa cập nhật'}</p>
                                </div>
                            </div>
                            ${imagesHtml}
                            <hr />
                            <p><strong>Mô Tả:</strong></p>
                            <p>${data.description || 'Chưa cập nhật'}</p>
                        </div>
                    </div>
                `;
                // Hiển thị modal
                const accountModal = new bootstrap.Modal(document.getElementById('accountModal'));
                accountModal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Lỗi khi tải dữ liệu tài khoản!');
            });
    }
</script>
@endpush
