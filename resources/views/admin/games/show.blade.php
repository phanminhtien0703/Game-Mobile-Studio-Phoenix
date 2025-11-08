@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Chi tiết game</h1>
    <div>
        <h3>{{ $game->game_name }}</h3>
        <p><strong>Mô tả:</strong> {{ $game->description }}</p>
        <p><strong>Trạng thái:</strong> {{ $game->game_status ? $game->game_status->status_name : 'Không xác định' }}</p>
        <p><strong>Ngày phát hành:</strong> {{ $game->release_date }}</p>
        <img src="{{ $game->image_url }}" alt="{{ $game->game_name }}" style="max-width: 100%; height: auto;">
    </div>
    <a href="{{ route('admin.games.index') }}" class="btn btn-primary">Quay lại danh sách</a>
</div>
@endsection