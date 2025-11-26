@extends('layouts.admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Quản Lý User</h5>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Thêm User
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Đăng Nhập</th>
                        <th>Email</th>
                        <th>Trạng Thái</th>
                        <th>Lần Đăng Nhập Cuối</th>
                        <th>IP Cuối Cùng</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->user_id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge {{ $user->status === 'active' ? 'bg-success' : ($user->status === 'banned' ? 'bg-danger' : 'bg-warning') }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td>
                                @if($user->last_login)
                                    {{ is_string($user->last_login) ? \Carbon\Carbon::parse($user->last_login)->format('d/m/Y H:i') : $user->last_login->format('d/m/Y H:i') }}
                                @else
                                    Chưa đăng nhập
                                @endif
                            </td>
                            <td>{{ $user->last_ip ?? 'N/A' }}</td>
                            <td>
                                <!-- <button class="btn btn-info btn-sm" onclick="viewUser({{ $user->user_id }})">
                                    <i class="bx bx-show"></i>
                                </button> -->
                                <a href="{{ route('admin.users.edit', $user->user_id) }}" class="btn btn-warning btn-sm">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.users.destroy', $user->user_id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn chắc chứ?')">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có User nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for viewing user details -->
<div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
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

<script>
function viewUser(userId) {
    fetch(`/admin/users/${userId}`)
        .then(response => response.json())
        .then(data => {
            const html = `
                <p><strong>ID:</strong> ${data.user_id}</p>
                <p><strong>Tên Đăng Nhập:</strong> ${data.username}</p>
                <p><strong>Email:</strong> ${data.email}</p>
                <p><strong>Trạng Thái:</strong> ${data.status}</p>
                <p><strong>Lần Đăng Nhập Cuối:</strong> ${data.last_login || 'Chưa đăng nhập'}</p>
                <p><strong>IP Cuối Cùng:</strong> ${data.last_ip || 'N/A'}</p>
                <p><strong>Ngày Tạo:</strong> ${new Date(data.created_at).toLocaleString()}</p>
                <p><strong>Cập Nhật:</strong> ${new Date(data.updated_at).toLocaleString()}</p>
            `;
            document.getElementById('userDetailsContent').innerHTML = html;
            new bootstrap.Modal(document.getElementById('viewUserModal')).show();
        })
        .catch(error => console.error('Error:', error));
}
</script>
@endsection
