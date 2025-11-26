@extends('layouts.admin.app')

@section('title', 'Quản Lý User | Game Mobile Studio')

@push('search-input')
<input
  type="text"
  id="searchUserInput"
  class="form-control border-0 shadow-none ps-1 ps-sm-2 d-md-block d-none"
  placeholder="Tìm kiếm người dùng..."
  aria-label="Search..." />
@endpush

@section('content')
  <!-- Basic Bootstrap Table -->
  <div class="card">
    <h5 class="card-header">Quản Lý User</h5>
    <div class="card-body">
      <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm mb-3">+ Thêm User</a>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Tên Đăng Nhập</th>
            <th class="text-center">Email</th>
            <th class="text-center">Trạng Thái</th>
            <th class="text-center">Lần Đăng Nhập Cuối</th>
            <th class="text-center">IP Cuối Cùng</th>
            <th class="text-center">Thao Tác</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($users as $user)
          <tr>
            <td class="text-center">{{ $user->user_id }}</td>
            <td class="text-center">{{ $user->username }}</td>
            <td class="text-center">{{ $user->email }}</td>
            <td class="text-center">
              <span class="badge {{ $user->status === 'active' ? 'bg-success' : ($user->status === 'banned' ? 'bg-danger' : 'bg-warning') }}">
                {{ ucfirst($user->status) }}
              </span>
            </td>
            <td class="text-center">
              @if($user->last_login)
                {{ is_string($user->last_login) ? \Carbon\Carbon::parse($user->last_login)->format('d/m/Y H:i') : $user->last_login->format('d/m/Y H:i') }}
              @else
                Chưa đăng nhập
              @endif
            </td>
            <td class="text-center">{{ $user->last_ip ?? 'N/A' }}</td>
            <td class="text-center">
              <a href="javascript:void(0);" onclick="viewUser('{{ $user->user_id }}')" class="btn btn-info btn-sm" title="Xem chi tiết">
                <i class="bx bx-show"></i>
              </a>
              <a href="{{ route('admin.users.edit', $user->user_id) }}" class="btn btn-warning btn-sm" title="Chỉnh sửa">
                <i class="bx bx-edit"></i>
              </a>
              <form method="POST" action="{{ route('admin.users.destroy', $user->user_id) }}" style="display:inline;">
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
                <p class="mb-0">Chưa có user nào.</p>
                <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary mt-2">
                  <i class="bx bx-plus me-1"></i>Tạo user đầu tiên
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

  <!-- Modal for viewing user details -->
  <div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewUserModalLabel">Chi Tiết User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="userDetailsContent">
          <!-- User details will be loaded here -->
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
    document.getElementById('searchUserInput').addEventListener('keyup', function() {
        const searchText = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('tbody tr');
        
        tableRows.forEach(function(row) {
            // Skip empty state row
            if (row.querySelector('td[colspan]')) {
                return;
            }
            
            const id = row.cells[0].textContent;
            const username = row.cells[1].textContent;
            const email = row.cells[2].textContent;
            const status = row.cells[3].textContent;
            
            const searchableText = id + ' ' + username + ' ' + email + ' ' + status;
            
            if (fuzzyMatch(searchableText, searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    function viewUser(userId) {
        console.log("user_id = " + userId);
        fetch(`/admin/users/${userId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const html = `
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <p><strong>ID:</strong> ${data.user_id}</p>
                                    <p><strong>Tên Đăng Nhập:</strong> ${data.username}</p>
                                    <p><strong>Email:</strong> ${data.email}</p>
                                </div>
                                <div class="col-6">
                                    <p><strong>Trạng Thái:</strong> <span class="badge ${data.status === 'active' ? 'bg-success' : (data.status === 'banned' ? 'bg-danger' : 'bg-warning')}">${data.status}</span></p>
                                    <p><strong>Lần Đăng Nhập Cuối:</strong> ${data.last_login || 'Chưa đăng nhập'}</p>
                                    <p><strong>IP Cuối Cùng:</strong> ${data.last_ip || 'N/A'}</p>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-6">
                                    <p><strong>Ngày Tạo:</strong> ${data.created_at || 'N/A'}</p>
                                </div>
                                <div class="col-6">
                                    <p><strong>Cập Nhật Lần Cuối:</strong> ${data.updated_at || 'N/A'}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                document.getElementById('userDetailsContent').innerHTML = html;
                new bootstrap.Modal(document.getElementById('viewUserModal')).show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Lỗi khi tải dữ liệu user!');
            });
    }
</script>
@endpush
