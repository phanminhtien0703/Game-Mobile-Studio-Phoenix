<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class HomeController extends Controller
{
    /**
     * Display the home page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Lấy các game có banner để hiển thị trên carousel
        $games = Game::whereNotNull('banner_url')
                     ->where('banner_url', '!=', '')
                     ->get();
        
        // Lấy các game đề xuất (tất cả games, limit 7)
        $recommendedGames = Game::with('game_status')->limit(7)->get();
        
        return view('home.index', compact('games', 'recommendedGames'));
    }
}
