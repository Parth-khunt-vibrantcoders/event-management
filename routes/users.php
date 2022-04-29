<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\DashboardController;
use App\Http\Controllers\frontend\LoginController;
use App\Http\Controllers\frontend\BookingController;
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
Route::get('user-logout', [LoginController::class, 'logout'])->name('user-logout');

$usersPrefix = "users";
Route::group(['prefix' => $usersPrefix, 'middleware' => ['users']], function() {
    Route::get('my-dashboard', [DashboardController::class, 'dashboard'])->name('my-dashboard');

    Route::get('my-booking', [BookingController::class, 'booking'])->name('my-booking');
    Route::get('view-booking/{id}', [BookingController::class, 'view'])->name('view-booking');
});
?>
