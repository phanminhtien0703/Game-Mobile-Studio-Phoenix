<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::with('game')->orderBy('created_at', 'desc')->get();
        return view('admin.discounts', compact('discounts'));
    }

    public function create()
    {
        $games = Game::all();
        return view('admin.discounts.create', compact('games'));
    }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'game_id' => 'required|string|exists:games,game_id',
            'event_name' => 'required|string|max:255',
            'banner_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'event_link' => 'nullable|url|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Handle banner upload
        if ($request->hasFile('banner_url')) {
            $bannerPath = $request->file('banner_url')->store('uploads/discounts', 'public');
            $validated['banner_url'] = '/storage/' . $bannerPath;
        }

        // Set created_at
        $validated['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');

        // Create discount
        Discount::create($validated);

        return redirect()->route('admin.discounts.index')->with('success', 'Tạo sự kiện giảm giá thành công!');
    }

    public function edit(Discount $discount)
    {
        $games = Game::all();
        return view('admin.discounts.edit', compact('discount', 'games'));
    }

    public function update(Request $request, Discount $discount)
    {
        // Validate input
        $validated = $request->validate([
            'game_id' => 'required|string|exists:games,game_id',
            'event_name' => 'required|string|max:255',
            'banner_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'event_link' => 'nullable|url|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Handle banner upload
        if ($request->hasFile('banner_url')) {
            // Xóa file cũ nếu có
            if ($discount->banner_url && strpos($discount->banner_url, '/storage/') === 0) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $discount->banner_url));
            }
            $bannerPath = $request->file('banner_url')->store('uploads/discounts', 'public');
            $validated['banner_url'] = '/storage/' . $bannerPath;
        }

        // Update discount (không update updated_at vì bảng không có cột này)
        $discount->update($validated);

        return redirect()->route('admin.discounts.index')->with('success', 'Cập nhật sự kiện giảm giá thành công!');
    }

    public function destroy(Discount $discount)
    {
        // Xóa file banner nếu có
        if ($discount->banner_url && strpos($discount->banner_url, '/storage/') === 0) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $discount->banner_url));
        }
        
        $discount->delete();
        return redirect()->route('admin.discounts.index')->with('success', 'Xóa sự kiện giảm giá thành công!');
    }

    public function show($discount_id)
    {
        $discount = Discount::with('game')->find($discount_id);

        if (!$discount) {
            return response()->json(['error' => 'Discount not found'], 404);
        }

        return response()->json([
            'discount_id' => $discount->discount_id,
            'game_id' => $discount->game_id,
            'game_name' => $discount->game ? $discount->game->game_name : 'N/A',
            'event_name' => $discount->event_name,
            'banner_url' => $discount->banner_url,
            'event_link' => $discount->event_link,
            'start_date' => $discount->start_date,
            'end_date' => $discount->end_date,
            'created_at' => $discount->created_at,
        ]);
    }
}
