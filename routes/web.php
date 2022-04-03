<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\RoomController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('user')->group(function (){
    Route::get('/login', [AuthController::class, 'loginView']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function (){
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Hotel
    Route::prefix('hotels')->group(function (){
        Route::get('/', [HotelController::class, 'index'])->name('hotel.list');
        Route::post('/', [HotelController::class, 'create']);
        Route::get('/{id}', [HotelController::class, 'show'])->name('hotel.show');
        Route::post('/{id}', [HotelController::class, 'edit']);
        Route::get('/delete/{id}', [HotelController::class, 'destroy'])->name('hotel.delete');
    });

    // Room
    Route::prefix('rooms')->group(function (){
        Route::get('/', [RoomController::class, 'index'])->name('room.list');
        Route::post('/', [RoomController::class, 'create']);
        Route::get('/{id}', [RoomController::class, 'show'])->name('room.show');
        Route::post('/{id}', [RoomController::class, 'edit']);
        Route::get('/delete/{id}', [RoomController::class, 'destroy'])->name('room.delete');
    });

    Route::prefix('availabilities')->group(function (){
        Route::get('/', [AvailabilityController::class, 'index'])->name('availability.list');
        Route::post('/', [AvailabilityController::class, 'create']);
        Route::get('/{id}', [AvailabilityController::class, 'show'])->name('availability.show');
        Route::post('/{id}', [AvailabilityController::class, 'edit']);
        Route::get('/delete/{id}', [AvailabilityController::class, 'destroy'])->name('availability.delete');
    });
});

// Route::middleware(['userloggedin'])->group(function() {
//     Route::prefix('/', [HomeController::class, 'index'])->name('home.loggedin');
// });