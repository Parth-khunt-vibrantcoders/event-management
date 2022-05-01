<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\frontend\PackagesController;
use App\Http\Controllers\frontend\ContactusController;
use App\Http\Controllers\frontend\DashboardController;
use App\Http\Controllers\frontend\LoginController as SigninController;
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

Route::get('category', [CategoryController::class, 'category_list'])->name('category');
Route::get('category-details/{id}', [CategoryController::class, 'category_details'])->name('category-details');

Route::get('packages', [PackagesController::class, 'packages_list'])->name('packages');
Route::get('packages-details/{id}', [PackagesController::class, 'packages_details'])->name('packages-details');

Route::get('contact-us', [ContactusController::class, 'contact_us'])->name('contact-us');
Route::get('save-contact-form', [ContactusController::class, 'save_contact_form'])->name('save-contact-form');

Route::get('sign-in', [SigninController::class, 'signin'])->name('sign-in');
Route::post('check-sign-in', [SigninController::class, 'check_sign_in'])->name('check-sign-in');

Route::get('sign-up', [SigninController::class, 'signup'])->name('sign-up');
Route::post('save-sign-up', [SigninController::class, 'signup_save'])->name('save-sign-up');


