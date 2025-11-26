@extends('layouts.admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Chỉnh Sửa Người Dùng</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.update', $user->user_id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label" for="username">Tên Đăng Nhập</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" 
                                   id="username" name="username" value="{{ old('username', $user->username) }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Mật Khẩu (Để trống nếu không thay đổi)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">Xác Nhận Mật Khẩu</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                   id="password_confirmation" name="password_confirmation">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="status">Trạng Thái</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">-- Chọn Trạng Thái --</option>
                                <option value="active" {{ old('status', $user->status) === 'active' ? 'selected' : '' }}>Kích Hoạt</option>
                                <option value="inactive" {{ old('status', $user->status) === 'inactive' ? 'selected' : '' }}>Không Kích Hoạt</option>
                                <option value="banned" {{ old('status', $user->status) === 'banned' ? 'selected' : '' }}>Bị Cấm</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Thông Tin Bổ Sung</label>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Ngày Tạo:</strong></td>
                                    <td>{{ $user->created_at ? (is_string($user->created_at) ? \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i') : $user->created_at->format('d/m/Y H:i')) : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Cập Nhật Lần Cuối:</strong></td>
                                    <td>{{ $user->updated_at ? (is_string($user->updated_at) ? \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y H:i') : $user->updated_at->format('d/m/Y H:i')) : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Lần Đăng Nhập Cuối:</strong></td>
                                    <td>{{ $user->last_login ? (is_string($user->last_login) ? \Carbon\Carbon::parse($user->last_login)->format('d/m/Y H:i') : $user->last_login->format('d/m/Y H:i')) : 'Chưa đăng nhập' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>IP Cuối Cùng:</strong></td>
                                    <td>{{ $user->last_ip ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-check"></i> Cập Nhật
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                <i class="bx bx-arrow-back"></i> Quay Lại
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
