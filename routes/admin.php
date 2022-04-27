<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\dashboard\DashboardController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\backend\dashboard\SystemsettingController;
use App\Http\Controllers\backend\audittrails\AuditTrailsController;
use App\Http\Controllers\backend\dashboard\SmtpsettingController;
use App\Http\Controllers\backend\eventcategory\EventcategoryController;

use App\Http\Controllers\backend\users\UsersController;
use App\Http\Controllers\backend\users\SubscriberController;

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

});



?>
