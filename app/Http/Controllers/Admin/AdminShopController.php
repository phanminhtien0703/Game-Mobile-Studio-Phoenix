<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountForSale;
use App\Models\User;
use App\Models\Game;
use Illuminate\Http\Request;

class AdminShopController extends Controller
{
    public function index()
    {
        $accounts = AccountForSale::with('user', 'game')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.shops.index', compact('accounts'));
    }

    public function create()
    {
        $users = User::where('status', 'active')->orderBy('username')->get();
        $games = Game::orderBy('game_name')->get();
        
        return view('admin.shops.create', compact('users', 'games'));
    }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'game_id' => 'required|exists:games,game_id',
            'character_name' => 'required|string|max:255',
            'server_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,approved,sold,rejected',
        ], [
            'user_id.required' => 'Người bán không được để trống',
            'user_id.exists' => 'Người bán không tồn tại',
            'game_id.required' => 'Trò chơi không được để trống',
            'game_id.exists' => 'Trò chơi không tồn tại',
            'character_name.required' => 'Tên nhân vật không được để trống',
            'server_name.required' => 'Tên server không được để trống',
            'price.required' => 'Giá không được để trống',
            'price.numeric' => 'Giá phải là số',
            'status.required' => 'Trạng thái không được để trống',
        ]);

        // Create account
        AccountForSale::create($validated);

        return redirect()->route('admin.shops.index')->with('success', 'Tạo tài khoản bán thành công!');
    }

    public function show(AccountForSale $shop)
    {
        $account = $shop->load('user', 'game');
        return view('admin.shops.show', compact('account'));
    }

    public function edit(AccountForSale $shop)
    {
        $account = $shop;
        $users = User::where('status', 'active')->orderBy('username')->get();
        $games = Game::orderBy('game_name')->get();
        
        return view('admin.shops.edit', compact('account', 'users', 'games'));
    }

    public function update(Request $request, AccountForSale $shop)
    {
        // Validate input
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'game_id' => 'required|exists:games,game_id',
            'character_name' => 'required|string|max:255',
            'server_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,approved,sold,rejected',
        ], [
            'user_id.required' => 'Người bán không được để trống',
            'user_id.exists' => 'Người bán không tồn tại',
            'game_id.required' => 'Trò chơi không được để trống',
            'game_id.exists' => 'Trò chơi không tồn tại',
            'character_name.required' => 'Tên nhân vật không được để trống',
            'server_name.required' => 'Tên server không được để trống',
            'price.required' => 'Giá không được để trống',
            'price.numeric' => 'Giá phải là số',
            'status.required' => 'Trạng thái không được để trống',
        ]);

        // Update account
        $shop->update($validated);

        return redirect()->route('admin.shops.index')->with('success', 'Cập nhật tài khoản bán thành công!');
    }

    public function destroy(AccountForSale $shop)
    {
        $shop->delete();
        return redirect()->route('admin.shops.index')->with('success', 'Xóa tài khoản bán thành công!');
    }

    public function getJson(AccountForSale $shop)
    {
        $account = $shop->load('user', 'game');

        // Handle images
        $images = $account->images;
        if (is_string($images)) {
            $images = json_decode($images, true);
        }
        $images = is_array($images) ? $images : [];

        return response()->json([
            'id' => $account->id,
            'character_name' => $account->character_name,
            'game_name' => $account->game->game_name ?? 'N/A',
            'server_name' => $account->server_name,
            'seller_username' => $account->user->username ?? 'N/A',
            'price' => $account->price,
            'status' => $account->status,
            'views' => $account->views ?? 0,
            'description' => $account->description,
            'images' => $images,
            'created_at' => $account->created_at ? (is_string($account->created_at) ? \Carbon\Carbon::parse($account->created_at)->format('d/m/Y H:i:s') : $account->created_at->format('d/m/Y H:i:s')) : 'N/A',
        ]);
    }
}
