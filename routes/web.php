<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TouristController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\GiftcodeController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirect root to admin login
Route::get('/', [HomeController::class, 'index'])->name('home.index');

// Public routes - Event listing
Route::get('/events', [DiscountController::class, 'listActive'])->name('home.events');

// Admin Login Routes (không cần authentication)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'loginPost'])->name('admin.login.post');
});

// Admin Protected Routes (cần authentication)
Route::prefix('admin')->middleware(['admin.auth'])->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    
    Route::resource('admins', AdminController::class)->names('admin.admins');

    // Game routes
    Route::resource('games', GameController::class)->names('admin.games');
    Route::get('/games/{game_id}', [GameController::class, 'show'])->name('admin.games.show')->where('game_id', '.*');

    // Discount routes
    Route::resource('discounts', DiscountController::class)->names('admin.discounts');
    Route::get('/discounts/{discount_id}', [DiscountController::class, 'show'])->name('admin.discounts.show');

    // Giftcode routes
    Route::resource('giftcodes', GiftcodeController::class)->names('admin.giftcodes');
    Route::get('/giftcodes/{giftcode_id}', [GiftcodeController::class, 'show'])->name('admin.giftcodes.show');

    // Activity routes
    Route::get('/activities', [ActivityController::class, 'index'])->name('admin.activities.index');

    // Tourist routes
    Route::get('/tourists', [TouristController::class, 'index'])->name('admin.tourists.index');
});
