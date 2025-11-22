@extends('layouts.home.main')

@section('content')
<div class="d-flex flex-column gap-5 mt-5" style="margin: 0px 12px;">
    <div class="welfare">
        <div class="d-flex justify-content-between align-items-center mb-3 text-white">
            <h3 class="text-title">TẤT CẢ SỰ KIỆN</h3>
        </div>
        
        @if($events->isEmpty())
            <div class="alert alert-info text-center">
                <p>Không có sự kiện nào đang diễn ra</p>
            </div>
        @else
            <div class="events-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px;">
                @foreach($events as $event)
                    <div class="event-card" style="background: #1a1a1a; border-radius: 8px; overflow: hidden; transition: transform 0.3s ease;">
                        <!-- Banner Image -->
                        <div style="position: relative; width: 100%; height: 200px; overflow: hidden; background: #333;">
                            <a href="{{ $event->event_link ?? '#' }}" target="_blank" style="display: block; width: 100%; height: 100%; text-decoration: none;">
                                <img src="{{ $event->banner_url ? asset($event->banner_url) : asset('home/images/loading.png') }}" 
                                     alt="{{ $event->event_name }}" 
                                     style="width: 100%; height: 100%; object-fit: cover; display: block;">
                            </a>
                            
                            <!-- Event Badge -->
                            <div style="position: absolute; top: 8px; right: 8px; background: rgba(255, 107, 107, 0.9); color: white; padding: 4px 12px; border-radius: 4px; font-size: 12px; font-weight: bold; z-index: 10;">
                                SỰ KIỆN
                            </div>

                            <!-- Days Remaining -->
                            @php
                                $daysRemaining = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->diffInDays($event->end_date, false);
                                $daysClass = $daysRemaining <= 3 ? 'danger' : ($daysRemaining <= 7 ? 'warning' : 'info');
                            @endphp
                            <div style="position: absolute; bottom: 8px; left: 8px; background: rgba(0, 0, 0, 0.8); color: #ffc107; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: bold;">
                                ⏰ @if($daysRemaining > 0) {{ $daysRemaining }} ngày @else Hôm nay @endif
                            </div>
                        </div>

                        <!-- Event Info -->
                        <div style="padding: 16px; color: #f0f0f0;">
                            <h4 style="margin: 0 0 8px 0; font-size: 16px; font-weight: bold; text-align: left; color: #ffffff;">
                                {{ Str::limit($event->event_name, 50) }}
                            </h4>

                            <!-- Dates -->
                            <div style="font-size: 12px; color: #999; margin-bottom: 12px; text-align: left;">
                                <p style="margin: 4px 0;">📅 Từ: {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}</p>
                                <p style="margin: 4px 0;">📅 Đến: {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</p>
                            </div>

                            <!-- Action Button -->
                            <a href="{{ $event->event_link ?? '#' }}" 
                               target="_blank"
                               onclick="recordEventClick('{{ $event->discount_id }}')"
                               style="display: inline-block; width: 100%; padding: 10px; background: linear-gradient(135deg, #FF6B6B 0%, #FF4757 100%); color: white; text-align: center; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 14px; border: none; cursor: pointer; transition: opacity 0.3s ease;">
                                Tham Gia Sự Kiện
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
    .events-grid {
        animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .event-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .event-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(255, 107, 107, 0.2);
    }

    .event-card:hover img {
        transform: scale(1.05);
    }

    .event-card img {
        transition: transform 0.3s ease;
    }
</style>

<script>
    function recordEventClick(eventId) {
        // Có thể thêm tracking tại đây nếu cần
        console.log('Event clicked:', eventId);
    }
</script>
@endsection