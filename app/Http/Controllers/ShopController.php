<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\AccountForSale;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        // Lấy các game có banner để hiển thị trên carousel
        $bannerGames = Game::whereNotNull('banner_url')
                           ->where('banner_url', '!=', '')
                           ->limit(5)
                           ->get();
        
        // Nếu không có banner game, lấy tất cả game làm fallback
        if ($bannerGames->isEmpty()) {
            $bannerGames = Game::limit(5)->get();
        }

        // Lấy các tài khoản bán được phê duyệt
        $accounts = AccountForSale::with('user', 'game')
                                  ->orderBy('created_at', 'desc')
                                  ->get();

        // Nếu là AJAX request, return chỉ content view
        if (request()->wantsJson()) {
            $html = view('shop.index', compact('bannerGames', 'accounts'))->render();
            return response()->json([
                'content' => $html
            ]);
        }

        return view('shop.index', compact('bannerGames', 'accounts'));
    }

    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('home.index')->with('error', 'Bạn cần đăng nhập để đăng bán');
        }

        $bannerGames = Game::whereNotNull('banner_url')
                           ->where('banner_url', '!=', '')
                           ->limit(5)
                           ->get();
        
        if ($bannerGames->isEmpty()) {
            $bannerGames = Game::limit(5)->get();
        }

        $games = Game::select('game_id', 'game_name')->get();
        return view('shop.create', compact('games', 'bannerGames'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('home.index')->with('error', 'Bạn cần đăng nhập');
        }

        $validated = $request->validate([
            'game_id' => 'required|exists:games,game_id',
            'character_name' => 'required|string|max:100',
            'server_name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'images' => 'required|array|max:5',
            'images.*' => 'required|image|mimes:jpeg,png,gif|max:5120',
        ], [
            'game_id.required' => 'Vui lòng chọn trò chơi',
            'game_id.exists' => 'Trò chơi không tồn tại',
            'character_name.required' => 'Tên nhân vật không được để trống',
            'character_name.max' => 'Tên nhân vật không quá 100 ký tự',
            'server_name.required' => 'Tên máy chủ không được để trống',
            'server_name.max' => 'Tên máy chủ không quá 100 ký tự',
            'price.required' => 'Giá không được để trống',
            'price.numeric' => 'Giá phải là số',
            'price.min' => 'Giá phải lớn hơn 0',
            'images.required' => 'Vui lòng tải lên ảnh',
            'images.max' => 'Tối đa 5 ảnh',
            'images.*.image' => 'Tệp phải là ảnh',
            'images.*.mimes' => 'Ảnh phải là JPG, PNG hoặc GIF',
            'images.*.max' => 'Ảnh không quá 5MB',
        ]);

        $imagePaths = [];
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('accounts', 'public');
                $imagePaths[] = '/storage/' . $path;
            }
        }

        AccountForSale::create([
            'user_id' => Auth::id(),
            'game_id' => $validated['game_id'],
            'character_name' => $validated['character_name'],
            'server_name' => $validated['server_name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'images' => $imagePaths,
            'status' => 'pending',
        ]);

        return redirect()->route('shop.index')
                       ->with('success', 'Tài khoản được thêm thành công. Chờ quản trị viên phê duyệt.');
    }

    public function show($id)
    {
        $account = AccountForSale::with('user', 'game')->findOrFail($id);
        
        // Tăng lượt xem
        $account->increment('views');

        // Lấy banner games
        $bannerGames = Game::whereNotNull('banner_url')
                           ->where('banner_url', '!=', '')
                           ->limit(5)
                           ->get();
        
        if ($bannerGames->isEmpty()) {
            $bannerGames = Game::limit(5)->get();
        }

        // Nếu là AJAX request, return chỉ content view
        if (request()->wantsJson()) {
            $html = view('shop.show', compact('account', 'bannerGames'))->render();
            return response()->json([
                'content' => $html
            ]);
        }

        return view('shop.show', compact('account', 'bannerGames'));
    }
}
