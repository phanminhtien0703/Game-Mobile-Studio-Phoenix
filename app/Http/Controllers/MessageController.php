<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function buyAccount(Request $request)
    {
        // Kiểm tra user đã đăng nhập
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để tiếp tục');
        }

        $accountId = $request->query('account_id');
        $game = $request->query('game', 'Game');
        $character = $request->query('character', 'Tài khoản');

        // Soạn sẵn tin nhắn
        $message = "Xin chào admin, tôi muốn mua tài khoản {$character} game {$game} (ID: {$accountId}). Bạn có còn tài khoản này không?";

        return view('messages.buy', compact('message', 'accountId', 'game', 'character'));
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'account_id' => 'required|integer',
            'message' => 'required|string|max:500',
        ], [
            'message.required' => 'Tin nhắn không được để trống',
            'message.max' => 'Tin nhắn không quá 500 ký tự',
        ]);

        // Lưu hoặc gửi message (tùy database structure)
        // Tạm thời chỉ lưu session và redirect
        
        return redirect()->route('shop.index')
                       ->with('success', 'Tin nhắn đã gửi cho admin. Admin sẽ liên hệ với bạn sớm nhất!');
    }
}
