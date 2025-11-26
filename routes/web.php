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
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminShopController;

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

// Shop routes
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/create', [ShopController::class, 'create'])->middleware('auth')->name('shop.create');
Route::get('/shop/{id}', [ShopController::class, 'show'])->where('id', '[0-9]+')->name('shop.show');
Route::post('/shop', [ShopController::class, 'store'])->middleware('auth')->name('shop.store');

// Message routes
Route::get('/message/buy', [MessageController::class, 'buyAccount'])->middleware('auth')->name('message.buy');
Route::post('/message/send', [MessageController::class, 'sendMessage'])->middleware('auth')->name('message.send');

// User Auth routes
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.post');
Route::get('/register', [UserController::class, 'showRegister'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.post');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

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

    // User routes
    Route::resource('users', AdminUserController::class)->names('admin.users');
    Route::get('/users/{user_id}', [AdminUserController::class, 'show'])->name('admin.users.show');

    // Shop routes
    Route::resource('shops', AdminShopController::class)->names('admin.shops');
    Route::get('/shops/{shop}', [AdminShopController::class, 'show'])->name('admin.shops.show');
    Route::get('/shops/{shop}/json', [AdminShopController::class, 'getJson'])->name('admin.shops.json');

    // Discount routes
    Route::resource('discounts', DiscountController::class)->names('admin.discounts');
    Route::get('/discounts/{discount_id}', [DiscountController::class, 'show'])->name('admin.discounts.show');

    // Giftcode routes
    Route::resource('giftcodes', GiftcodeController::class)->names('admin.giftcodes');
    Route::get('/giftcodes/{giftcode_id}', [GiftcodeController::class, 'show'])->name('admin.giftcodes.show');
    Route::post('/giftcodes/{giftcode_id}/claim', [GiftcodeController::class, 'claimGiftcode'])->name('giftcodes.claim');

    // Activity routes
    Route::get('/activities', [ActivityController::class, 'index'])->name('admin.activities.index');

    // Tourist routes
    Route::get('/tourists', [TouristController::class, 'index'])->name('admin.tourists.index');
});
