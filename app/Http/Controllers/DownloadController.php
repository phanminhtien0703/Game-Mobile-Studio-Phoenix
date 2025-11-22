<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DownloadController extends Controller
{
    /**
     * Record a download for a game
     *
     * @param Request $request
     * @param string $gameId
     * @return \Illuminate\Http\JsonResponse
     */
    public function recordDownload(Request $request, $gameId)
    {
        try {
            // Find the game
            $game = Game::where('game_id', $gameId)->first();
            
            if (!$game) {
                return response()->json([
                    'success' => false,
                    'message' => 'Game không tồn tại'
                ], 404);
            }

            // Increment download count
            DB::table('games')
                ->where('game_id', $gameId)
                ->increment('download_count');

            // Get updated game
            $updatedGame = Game::where('game_id', $gameId)->first();

            return response()->json([
                'success' => true,
                'message' => 'Ghi nhận lượt tải thành công',
                'data' => [
                    'game_id' => $gameId,
                    'game_name' => $game->game_name,
                    'download_count' => $updatedGame->download_count,
                    'download_url' => $game->download_link
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ], 500);
        }
    }
}
