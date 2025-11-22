@extends('layouts.home.main')

@section('content')
    <!-- Recommended Games Section -->
    @if(isset($recommendedGames))
        @include('layouts.home.recommended-games')
    @endif

    <!-- Promotions/Events Section -->
    @if(isset($promotions))
        @include('layouts.home.promotions')
    @endif

    <!-- Giftcodes Section -->
    @if(isset($giftcodes))
        @include('layouts.home.giftcodes-section')
    @endif

    <!-- News Section -->
    @if(isset($news))
        @include('layouts.home.news')
    @endif
@endsection