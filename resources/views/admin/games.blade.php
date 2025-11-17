@extends('layouts.admin.app')

@section('title', 'Danh sách Game | Game Mobile Studio')

@push('search-input')
<input
  type="text"
  id="searchGameInput"
  class="form-control border-0 shadow-none ps-1 ps-sm-2 d-md-block d-none"
  placeholder="Tìm kiếm game..."
  aria-label="Search..." />
@endpush

@section('content')
  <!-- Basic Bootstrap Table -->
  <div class="card">
    <h5 class="card-header">Danh sách game</h5>
    <div class="card-body">
      <a href="{{ route('admin.games.create') }}" class="btn btn-primary btn-sm mb-3">+ Tạo Game Mới</a>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>Avatar</th>
            <th>Tên game</th>
            <th>Thể Loại</th>
            <th>Trạng Thái</th>
            <th>Hành Động</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($games as $game)
          <tr>
            <td>
              <img src="{{ $game->avatar_url }}" alt="Avatar" class="rounded" style="width: 50px; height: 50px;" />
            </td>
            <td>
                          <span>{{ $game->game_name }}</span>
                        </td>
                        <td>{{ $game->genre }}</td>
                        <td>
                          <span class="badge bg-label-info me-1">
                            {{ $game->game_status ? strtoupper($game->game_status->status_name) : 'Không xác định' }}
                          </span>
                        </td>
                        <td>
                          <div class="btn-group" role="group">
                            <a href="javascript:void(0);" onclick="showGameDetails('{{ $game->game_id }}')" class="btn btn-info btn-sm">Xem</a>
                            <a href="{{ route('admin.games.edit', $game->game_id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('admin.games.destroy', $game->game_id) }}" method="POST" style="display:inline;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xoá game này?')">Xoá</button>
                            </form>
                          </div>
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="5" class="text-center py-4">
                          <div class="text-muted">
                            <i class="bx bx-info-circle bx-sm mb-2"></i>
                            <p class="mb-0">Chưa có game nào.</p>
                            <a href="{{ route('admin.games.create') }}" class="btn btn-sm btn-primary mt-2">
                              <i class="bx bx-plus me-1"></i>Tạo game đầu tiên
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
  <div class="modal fade" id="gameModal" tabindex="-1" aria-labelledby="gameModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="gameModalLabel">Chi tiết game</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="gameModalBody">
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
    document.getElementById('searchGameInput').addEventListener('keyup', function() {
        const searchText = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('tbody tr');
        
        tableRows.forEach(function(row) {
            // Skip empty state row
            if (row.querySelector('td[colspan]')) {
                return;
            }
            
            const gameName = row.cells[1].textContent;
            const genre = row.cells[2].textContent;
            const status = row.cells[3].textContent;
            
            const searchableText = gameName + ' ' + genre + ' ' + status;
            
            if (fuzzyMatch(searchableText, searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    function showGameDetails(gameId) {
        console.log("game_id = " + gameId);
        // Gửi yêu cầu AJAX để lấy dữ liệu chi tiết game
        fetch(`/admin/games/${gameId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Cập nhật nội dung modal với đầy đủ thông tin
                document.getElementById('gameModalBody').innerHTML = `
                    <div class="row">
                        <div class="col-md-5">
                            <img src="${data.avatar_url}" alt="${data.game_name}" class="img-fluid rounded mb-3" />
                            ${data.banner_url ? `<img src="${data.banner_url}" alt="Banner" class="img-fluid rounded" />` : ''}
                        </div>
                        <div class="col-md-7">
                            <h5 class="mb-3">${data.game_name}</h5>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <p><strong>ID Game:</strong> ${data.game_id}</p>
                                    <p><strong>Thể loại:</strong> ${data.genre || 'Chưa cập nhật'}</p>
                                    <p><strong>Trạng thái:</strong> <span class="badge bg-label-info">${data.status_name}</span></p>
                                </div>
                                <div class="col-6">
                                    <p><strong>Status Code:</strong> ${data.status || 'Chưa cập nhật'}</p>
                                    <p><strong>Ngày phát hành:</strong> ${data.release_date ? new Date(data.release_date).toLocaleDateString('vi-VN') : 'Chưa cập nhật'}</p>
                                    <p><strong>Cập nhật lần cuối:</strong> ${data.last_updated ? new Date(data.last_updated).toLocaleDateString('vi-VN') : 'Chưa cập nhật'}</p>
                                </div>
                            </div>
                            <hr />
                            <p><strong>Mô tả:</strong></p>
                            <p>${data.description || 'Chưa cập nhật'}</p>
                            <hr />
                            <p><strong>Link tải xuống:</strong></p>
                            ${data.download_link ? `<a href="${data.download_link}" target="_blank" class="btn btn-sm btn-primary">Tải xuống</a>` : '<span class="text-muted">Chưa cập nhật</span>'}
                        </div>
                    </div>
                `;
                // Hiển thị modal
                const gameModal = new bootstrap.Modal(document.getElementById('gameModal'));
                gameModal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Lỗi khi tải dữ liệu game!');
            });
    }
</script>
@endpush

