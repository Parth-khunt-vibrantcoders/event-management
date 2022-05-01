<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\dashboard\DashboardController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\backend\dashboard\SystemsettingController;
use App\Http\Controllers\backend\audittrails\AuditTrailsController;
use App\Http\Controllers\backend\dashboard\SmtpsettingController;
use App\Http\Controllers\backend\eventcategory\EventcategoryController;
use App\Http\Controllers\backend\places\PlacesController;
use App\Http\Controllers\backend\packages\PackagesController;
use App\Http\Controllers\backend\booking\BookingController;

use App\Http\Controllers\backend\users\UsersController;
use App\Http\Controllers\backend\users\SubscriberController;
use App\Http\Controllers\backend\contactus\ContactusController;

Route::get('admin-logout', [LoginController::class, 'logout'])->name('admin-logout');

$adminPrefix = "admin";
Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('admin-update-profile', [DashboardController::class, 'update_profile'])->name('admin-update-profile');
    Route::post('admin-save-profile', [DashboardController::class, 'save_profile'])->name('admin-save-profile');

    Route::get('admin-change-password', [DashboardController::class, 'change_password'])->name('admin-change-password');
    Route::post('save-password', [DashboardController::class, 'save_password'])->name('save-password');

    Route::post('common-ajaxcall', [CommonController::class, 'ajaxcall'])->name('common-ajaxcall');

    Route::get('admin-system-setting',[SystemsettingController::class,'system_setting'])->name('admin-system-setting');
    Route::post('save-system-setting',[SystemsettingController::class,'system_setting'])->name('save-system-setting');

    $adminPrefix = "audittrails";
    Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
        Route::get('audit-trails', [AuditTrailsController::class, 'list'])->name('audit-trails');
        Route::post('audit-trails-ajaxcall', [AuditTrailsController::class, 'ajaxcall'])->name('audit-trails-ajaxcall');
    });

    $adminPrefix = "event-category";
    Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
        Route::get('event-category-list', [EventcategoryController::class, 'list'])->name('event-category-list');
        Route::get('event-category-add', [EventcategoryController::class, 'add'])->name('event-category-add');
        Route::post('save-event-category', [EventcategoryController::class, 'add_save_event_category'])->name('save-event-category');
        Route::get('event-category-edit/{id}', [EventcategoryController::class, 'edit'])->name('event-category-edit');
        Route::post('save-event-category-edit', [EventcategoryController::class, 'edit_save_event_category'])->name('save-event-category-edit');
        Route::post('event-category-ajaxcall', [EventcategoryController::class, 'ajaxcall'])->name('event-category-ajaxcall');
    });

    $adminPrefix = "places";
    Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
        Route::get('places-list', [PlacesController::class, 'list'])->name('places-list');
        Route::get('places-add', [PlacesController::class, 'add'])->name('places-add');
        Route::post('save-places', [PlacesController::class, 'add_save_places'])->name('save-places');
        Route::get('places-edit/{id}', [PlacesController::class, 'edit'])->name('places-edit');
        Route::post('save-places-edit', [PlacesController::class, 'edit_save_places'])->name('save-places-edit');
        Route::post('places-ajaxcall', [PlacesController::class, 'ajaxcall'])->name('places-ajaxcall');
    });

    $adminPrefix = "packages";
    Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
        Route::get('packages-list', [PackagesController::class, 'list'])->name('packages-list');
        Route::get('packages-add', [PackagesController::class, 'add'])->name('packages-add');
        Route::post('save-packages', [PackagesController::class, 'add_save_packages'])->name('save-packages');
        Route::get('packages-edit/{id}', [PackagesController::class, 'edit'])->name('packages-edit');
        Route::post('save-packages-edit', [PackagesController::class, 'edit_save_packages'])->name('save-packages-edit');
        Route::post('packages-ajaxcall', [PackagesController::class, 'ajaxcall'])->name('packages-ajaxcall');
    });

    $adminPrefix = "booking";
    Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
        Route::get('booking-list', [BookingController::class, 'list'])->name('booking-list');
        Route::post('booking-ajaxcall', [BookingController::class, 'ajaxcall'])->name('booking-ajaxcall');
    });

    $adminPrefix = "contact-us";
    Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {
        Route::get('contact-us-list', [ContactusController::class, 'list'])->name('contact-us-list');
        Route::post('contact-us-ajaxcall', [ContactusController::class, 'ajaxcall'])->name('contact-us-ajaxcall');
    });

});



?>
