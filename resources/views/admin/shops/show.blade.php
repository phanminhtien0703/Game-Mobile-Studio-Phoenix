@extends('layouts.admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Chi Tiết Tài Khoản Bán</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td width="30%"><strong>ID:</strong></td>
                            <td>{{ $account->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Tên Nhân Vật:</strong></td>
                            <td>{{ $account->character_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Trò Chơi:</strong></td>
                            <td>{{ $account->game->game_name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Người Bán:</strong></td>
                            <td>{{ $account->user->username ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Server:</strong></td>
                            <td>{{ $account->server_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Giá:</strong></td>
                            <td>{{ number_format($account->price) }} đ</td>
                        </tr>
                        <tr>
                            <td><strong>Mô Tả:</strong></td>
                            <td>{{ $account->description ?? 'Không có' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Trạng Thái:</strong></td>
                            <td>
                                <span class="badge 
                                    {{ $account->status === 'approved' ? 'bg-success' : 
                                       ($account->status === 'pending' ? 'bg-warning' : 
                                       ($account->status === 'sold' ? 'bg-secondary' : 'bg-danger')) }}">
                                    {{ ucfirst($account->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Lượt Xem:</strong></td>
                            <td>{{ $account->views ?? 0 }}</td>
                        </tr>
                        <tr>
                            <td><strong>Ngày Tạo:</strong></td>
                            <td>{{ $account->created_at ? (is_string($account->created_at) ? \Carbon\Carbon::parse($account->created_at)->format('d/m/Y H:i:s') : $account->created_at->format('d/m/Y H:i:s')) : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Cập Nhật Lần Cuối:</strong></td>
                            <td>{{ $account->updated_at ? (is_string($account->updated_at) ? \Carbon\Carbon::parse($account->updated_at)->format('d/m/Y H:i:s') : $account->updated_at->format('d/m/Y H:i:s')) : 'N/A' }}</td>
                        </tr>
                    </table>

                    @if($account->images)
                    <div class="mt-4">
                        <h6 class="mb-3">Hình Ảnh Tài Khoản</h6>
                        <div class="row">
                            @php
                                $images = $account->images;
                                if (is_string($images)) {
                                    $images = json_decode($images, true);
                                }
                                $images = is_array($images) ? $images : [];
                            @endphp
                            @foreach($images as $image)
                                <div class="col-md-3 mb-3">
                                    <img src="{{ $image }}" alt="Account Image" class="img-fluid rounded" style="max-height: 150px; object-fit: cover;">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('admin.shops.edit', $account->id) }}" class="btn btn-warning">
                            <i class="bx bx-edit"></i> Chỉnh Sửa
                        </a>
                        <form method="POST" action="{{ route('admin.shops.destroy', $account->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn chắc chứ?')">
                                <i class="bx bx-trash"></i> Xóa
                            </button>
                        </form>
                        <a href="{{ route('admin.shops.index') }}" class="btn btn-secondary">
                            <i class="bx bx-arrow-back"></i> Quay Lại
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
