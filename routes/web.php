<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\frontend\HomeController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    echo "Cache is cleared<br>";
    Artisan::call('route:clear');
    echo "route cache is cleared<br>";
    Artisan::call('config:clear');
    echo "config is cleared<br>";
    Artisan::call('view:clear');
    echo "view is cleared<br>";
});
Route::get('', [HomeController::class, 'home'])->name('home');

Route::get('admin-login', [LoginController::class, 'login'])->name('admin-login');
Route::post('check-login', [LoginController::class, 'check_login'])->name('check-login');
Route::get('/testing-mail', [LoginController::class, 'testingmail'])->name('testing-mail');
