<?php

namespace App\Http\Controllers;

use App\Models\Giftcode;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GiftcodeController extends Controller
{
    public function index()
    {
        // Hiển thị tất cả giftcode kèm thông tin game
        $giftcodes = Giftcode::with('game')->get();
        
        return view('admin.giftcodes.index', compact('giftcodes'));
    }

    public function create()
    {
        // Lấy tất cả game kèm theo game_status
        $games = Game::with('game_status')->get();
        
        // Debug: Kiểm tra xem có game nào không
        if ($games->isEmpty()) {
            return view('admin.giftcodes.create', compact('games'))
                ->with('warning', 'Chưa có game nào trong database!');
        }
        
        return view('admin.giftcodes.create', compact('games'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_id' => 'required|string|exists:games,game_id',
            'message' => 'required|string',
            'total_quantity' => 'required|integer|min:1',
            'used_quantity' => 'required|integer|min:0|lte:total_quantity',
            'logo_game_url' => 'nullable|string|max:500',
        ]);

        // Logo URL đã được tự động lấy từ game (không cần xử lý upload)

        Giftcode::create($validated);

        return redirect()->route('admin.giftcodes.index')->with('success', 'Tạo giftcode thành công!');
    }

    public function edit(Giftcode $giftcode)
    {
        // Lấy tất cả game kèm theo game_status
        $games = Game::with('game_status')->get();
        return view('admin.giftcodes.edit', compact('giftcode', 'games'));
    }

    public function update(Request $request, Giftcode $giftcode)
    {
        $validated = $request->validate([
            'game_id' => 'required|string|exists:games,game_id',
            'message' => 'required|string',
            'total_quantity' => 'required|integer|min:1',
            'used_quantity' => 'required|integer|min:0|lte:total_quantity',
            'logo_game_url' => 'nullable|string|max:500',
        ]);

        // Logo URL đã được tự động lấy từ game (không cần xử lý upload)

        $giftcode->update($validated);

        return redirect()->route('admin.giftcodes.index')->with('success', 'Cập nhật giftcode thành công!');
    }

    public function destroy(Giftcode $giftcode)
    {
        // Delete logo file
        if ($giftcode->logo_game_url && strpos($giftcode->logo_game_url, '/storage/') === 0) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $giftcode->logo_game_url));
        }
        
        $giftcode->delete();
        return redirect()->route('admin.giftcodes.index')->with('success', 'Xóa giftcode thành công!');
    }

    public function show($giftcode_id)
    {
        $giftcode = Giftcode::with('game')->find($giftcode_id);

        if (!$giftcode) {
            return response()->json(['error' => 'Giftcode not found'], 404);
        }

        return response()->json([
            'giftcode_id' => $giftcode->giftcode_id,
            'game_id' => $giftcode->game_id,
            'game_name' => $giftcode->game ? $giftcode->game->game_name : 'N/A',
            'message' => $giftcode->message,
            'total_quantity' => $giftcode->total_quantity,
            'used_quantity' => $giftcode->used_quantity,
            'remaining_quantity' => $giftcode->remaining_quantity,
            'usage_percentage' => $giftcode->usage_percentage,
            'logo_game_url' => $giftcode->logo_game_url,
            'created_at' => $giftcode->created_at,
            'updated_at' => $giftcode->updated_at,
        ]);
    }
}
