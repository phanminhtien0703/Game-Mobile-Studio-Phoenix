<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Get all active events (end_date >= today)
     */
    public function index()
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        
        $events = Discount::where('end_date', '>=', $today)
                          ->orderBy('start_date', 'desc')
                          ->get()
                          ->map(function ($event) {
                              return [
                                  'discount_id' => $event->discount_id,
                                  'game_id' => $event->game_id,
                                  'event_name' => $event->event_name,
                                  'banner_url' => $event->banner_url ? asset($event->banner_url) : null,
                                  'event_link' => $event->event_link,
                                  'start_date' => $event->start_date,
                                  'end_date' => $event->end_date,
                              ];
                          });
        
        return response()->json([
            'success' => true,
            'events' => $events,
            'count' => $events->count(),
        ]);
    }
}
