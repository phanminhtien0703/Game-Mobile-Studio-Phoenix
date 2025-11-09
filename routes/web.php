<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TouristController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\GiftcodeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('admin')->group(function () {
    // Admin routes
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
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

// Route::get('/users', [UserController::class, 'index']);

// Route::prefix('admin')->group(function () {
//     Route::get('/', function () {
//         return view('admin.admin');
//     });

//     Route::get('/dashboard', function () {
//         return view('admin.dashboard');
//     });
// });
