<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Discount;
use App\Models\Giftcode;

class HomeController extends Controller
{
    /**
     * Display the home page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Lấy các game có banner để hiển thị trên carousel (tất cả game có banner, không phân biệt status)
        $bannerGames = Game::whereNotNull('banner_url')
                           ->where('banner_url', '!=', '')
                           ->limit(5)
                           ->get();
        
        // Nếu không có banner game, lấy tất cả game làm fallback
        if ($bannerGames->isEmpty()) {
            $bannerGames = Game::limit(5)->get();
        }
        
        // Lấy các game đề xuất (tất cả games, limit 7, sắp xếp theo sort_order)
        $recommendedGames = Game::with('game_status')
                                ->orderBy('sort_order', 'asc')
                                ->limit(7)
                                ->get();
        
        // Lấy các sự kiện/khuyến mãi từ bảng discounts (limit 5)
        $promotions = Discount::whereNotNull('banner_url')
                              ->where('banner_url', '!=', '')
                              ->where('end_date', '>=', now())
                              ->orderBy('start_date', 'desc')
                              ->limit(5)
                              ->get();
        
        // Nếu không có sự kiện đang diễn ra, lấy tất cả sự kiện
        if ($promotions->isEmpty()) {
            $promotions = Discount::whereNotNull('banner_url')
                                  ->where('banner_url', '!=', '')
                                  ->limit(5)
                                  ->get();
        }
        
        // Lấy các giftcode từ bảng giftcodes (limit 6)
        $giftcodes = Giftcode::with('game')
                             ->limit(6)
                             ->get();
        
        // Lấy các game để hiển thị tin tức/lịch khai mở server (limit 5, sắp xếp theo sort_order)
        $news = Game::with('game_status')
                    ->orderBy('sort_order', 'asc')
                    ->limit(5)
                    ->get();
        
        return view('home.index', compact('bannerGames', 'recommendedGames', 'promotions', 'giftcodes', 'news'));
    }
}
