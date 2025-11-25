<?php

namespace App\Helpers;

use App\Models\Game;

class BannerHelper
{
    /**
     * Lấy các game có banner để hiển thị trên carousel
     * 
     * @param int $limit Số lượng game tối đa (mặc định: 5)
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getBannerGames($limit = 5)
    {
        // Lấy các game có banner_url
        $bannerGames = Game::whereNotNull('banner_url')
                           ->where('banner_url', '!=', '')
                           ->limit($limit)
                           ->get();
        
        // Nếu không có banner game, lấy tất cả game làm fallback
        if ($bannerGames->isEmpty()) {
            $bannerGames = Game::limit($limit)->get();
        }

        return $bannerGames;
    }
}
