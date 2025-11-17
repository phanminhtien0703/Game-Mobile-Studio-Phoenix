@extends('layouts.admin.app')

@section('title', 'Chi tiết Game | Game Mobile Studio')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Chi tiết Game</h5>
            </div>
            <div class="card-body">
                <h3>{{ $game->game_name }}</h3>
                <p><strong>Mô tả:</strong> {{ $game->description }}</p>
                <p><strong>Trạng thái:</strong> {{ $game->game_status ? $game->game_status->status_name : 'Không xác định' }}</p>
                <p><strong>Ngày phát hành:</strong> {{ $game->release_date }}</p>
                @if($game->image_url)
                    <img src="{{ $game->image_url }}" alt="{{ $game->game_name }}" style="max-width: 100%; height: auto;">
                @endif
                <div class="mt-3">
                    <a href="{{ route('admin.games.index') }}" class="btn btn-primary">Quay lại danh sách</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
