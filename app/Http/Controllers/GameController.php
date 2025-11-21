<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function Psy\debug;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with('game_status')->orderBy('sort_order', 'asc')->get(); // Sắp xếp theo sort_order
        return view('admin.games.index', compact('games'));
    }

    public function create()
    {
        return view('admin.games.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'game_id' => 'required|string|unique:games,game_id|max:255',
            'game_name' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'avatar_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'download_link' => 'nullable|url|max:255',
            'status_id' => 'required|string|max:100',
            'sort_order' => 'nullable|integer',
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar_url')) {
            $avatarPath = $request->file('avatar_url')->store('uploads/avatars', 'public');
            $validated['avatar_url'] = '/storage/' . $avatarPath;
        }

        // Handle banner upload
        if ($request->hasFile('banner_url')) {
            $bannerPath = $request->file('banner_url')->store('uploads/banners', 'public');
            $validated['banner_url'] = '/storage/' . $bannerPath;
        }

        // Create game
        Game::create($validated);

        return redirect()->route('admin.games.index')->with('success', 'Tạo game thành công!');
    }

    public function edit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

    public function update(Request $request, Game $game)
    {
        // Validate input
        $validated = $request->validate([
            'game_name' => 'required|string|max:255',
            'genre' => 'required|string|max:100',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'avatar_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'download_link' => 'nullable|url|max:255',
            'status_id' => 'required|string|max:100',
            'sort_order' => 'nullable|integer',
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar_url')) {
            // Xóa file cũ nếu có
            if ($game->avatar_url && strpos($game->avatar_url, '/storage/') === 0) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $game->avatar_url));
            }
            $avatarPath = $request->file('avatar_url')->store('uploads/avatars', 'public');
            $validated['avatar_url'] = '/storage/' . $avatarPath;
        }

        // Handle banner upload
        if ($request->hasFile('banner_url')) {
            // Xóa file cũ nếu có
            if ($game->banner_url && strpos($game->banner_url, '/storage/') === 0) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $game->banner_url));
            }
            $bannerPath = $request->file('banner_url')->store('uploads/banners', 'public');
            $validated['banner_url'] = '/storage/' . $bannerPath;
        }

        // Update game
        $game->update($validated);

        return redirect()->route('admin.games.index')->with('success', 'Cập nhật game thành công!');
    }

    public function destroy(Game $game)
    {
        // Xóa files cũ nếu có
        if ($game->avatar_url && strpos($game->avatar_url, '/storage/') === 0) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $game->avatar_url));
        }
        if ($game->banner_url && strpos($game->banner_url, '/storage/') === 0) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $game->banner_url));
        }
        
        $game->delete();
        return redirect()->route('admin.games.index')->with('success', 'Xóa game thành công!');
    }

    public function show($game_id)
    {
        $game = Game::with('game_status')->find($game_id);

        if (!$game) {
            return response()->json(['error' => 'Game not found'], 404);
        }

        // Trả về JSON với tất cả dữ liệu game
        return response()->json([
            'game_id' => $game->game_id,
            'game_name' => $game->game_name,
            'genre' => $game->genre,
            'description' => $game->description,
            'release_date' => $game->release_date,
            'avatar_url' => $game->avatar_url,
            'banner_url' => $game->banner_url,
            'download_link' => $game->download_link,
            'status' => $game->status,
            'last_updated' => $game->last_updated,
            'status_name' => $game->game_status ? strtoupper($game->game_status->status_name) : 'Không xác định',
        ]);
    }
}

