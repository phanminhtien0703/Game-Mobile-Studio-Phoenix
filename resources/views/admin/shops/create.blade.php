@extends('layouts.admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Thêm Tài Khoản Bán Mới</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.shops.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="user_id">Người Bán</label>
                            <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                                <option value="">-- Chọn Người Bán --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->user_id }}" {{ old('user_id') == $user->user_id ? 'selected' : '' }}>
                                        {{ $user->username }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="game_id">Trò Chơi</label>
                            <select class="form-select @error('game_id') is-invalid @enderror" id="game_id" name="game_id" required>
                                <option value="">-- Chọn Trò Chơi --</option>
                                @foreach($games as $game)
                                    <option value="{{ $game->game_id }}" {{ old('game_id') == $game->game_id ? 'selected' : '' }}>
                                        {{ $game->game_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('game_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="character_name">Tên Nhân Vật</label>
                            <input type="text" class="form-control @error('character_name') is-invalid @enderror" 
                                   id="character_name" name="character_name" value="{{ old('character_name') }}" required>
                            @error('character_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="server_name">Tên Server</label>
                            <input type="text" class="form-control @error('server_name') is-invalid @enderror" 
                                   id="server_name" name="server_name" value="{{ old('server_name') }}" required>
                            @error('server_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="price">Giá (đ)</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price') }}" required min="0">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="description">Mô Tả</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="status">Trạng Thái</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">-- Chọn Trạng Thái --</option>
                                <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Chờ Duyệt</option>
                                <option value="approved" {{ old('status') === 'approved' ? 'selected' : '' }}>Đã Duyệt</option>
                                <option value="sold" {{ old('status') === 'sold' ? 'selected' : '' }}>Đã Bán</option>
                                <option value="rejected" {{ old('status') === 'rejected' ? 'selected' : '' }}>Từ Chối</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-check"></i> Tạo Mới
                            </button>
                            <a href="{{ route('admin.shops.index') }}" class="btn btn-secondary">
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
