<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem admin đã đăng nhập chưa
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login')->withErrors(['error' => 'Vui lòng đăng nhập để tiếp tục']);
        }

        // Cập nhật last_activity
        $adminId = Session::get('admin_id');
        \App\Models\Admin::where('admin_id', $adminId)->update([
            'last_activity' => now(),
            'last_ip' => $request->ip(),
        ]);

        return $next($request);
    }
}
