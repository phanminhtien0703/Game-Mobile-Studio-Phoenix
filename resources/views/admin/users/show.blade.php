@extends('layouts.admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Chi Tiết Người Dùng</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td width="30%"><strong>ID:</strong></td>
                            <td>{{ $user->user_id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tên Đăng Nhập:</strong></td>
                            <td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Trạng Thái:</strong></td>
                            <td>
                                <span class="badge {{ $user->status === 'active' ? 'bg-success' : ($user->status === 'banned' ? 'bg-danger' : 'bg-warning') }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Lần Đăng Nhập Cuối:</strong></td>
                            <td>{{ $user->last_login ? $user->last_login->format('d/m/Y H:i') : 'Chưa đăng nhập' }}</td>
                        </tr>
                        <tr>
                            <td><strong>IP Cuối Cùng:</strong></td>
                            <td>{{ $user->last_ip ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Ngày Tạo:</strong></td>
                            <td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Cập Nhật Lần Cuối:</strong></td>
                            <td>{{ $user->updated_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    </table>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.users.edit', $user->user_id) }}" class="btn btn-warning">
                            <i class="bx bx-edit"></i> Chỉnh Sửa
                        </a>
                        <form method="POST" action="{{ route('admin.users.destroy', $user->user_id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn chắc chứ?')">
                                <i class="bx bx-trash"></i> Xóa
                            </button>
                        </form>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="bx bx-arrow-back"></i> Quay Lại
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
