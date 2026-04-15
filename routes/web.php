<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeleteOrderController;
use App\Http\Controllers\Admin\EditOrderController;
use App\Http\Controllers\Admin\EditOrderStatusController;
use App\Http\Controllers\Admin\Order\ExportOrdersController;
use App\Http\Controllers\Admin\Order\OrderDetailsController;
use App\Http\Controllers\Admin\Order\OrdersController;
use App\Http\Controllers\Admin\Order\PrintController;
use App\Http\Controllers\Admin\Package\CreatePackageController;
use App\Http\Controllers\Admin\Package\DeletePackageController;
use App\Http\Controllers\Admin\Package\EditPackageController;
use App\Http\Controllers\Admin\Package\PackagesController;
use App\Http\Controllers\Admin\Payment\CreatePaymentController;
use App\Http\Controllers\Admin\Payment\DeletePaymentController;
use App\Http\Controllers\Client\BookingController;
use App\Http\Controllers\Client\CreateBookingController;
use App\Http\Controllers\Client\LandingController;
use Illuminate\Support\Facades\Route;



Route::get('/', [LandingController::class, 'index'])->name('client.landing');
Route::get('/{package}/booking', [BookingController::class, 'index'])->name('client.booking');
Route::post('/booking/store', [CreateBookingController::class, 'store'])->name('client.booking.store');




Route::prefix('admin')->group(function () {
    Route::middleware('authGuest')->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
        Route::post('/auth', [LoginController::class, 'login'])->name('admin.auth');
    });


    // Dashboard
    Route::middleware('authAdmin')->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');


        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('packages')->group(function () {
            Route::get('/', [PackagesController::class, 'index'])->name('admin.packages');
            Route::get('/create', [CreatePackageController::class, 'index'])->name('admin.packages.create');
            Route::get('/{package}/edit', [EditPackageController::class, 'index'])->name('admin.packages.edit');

            Route::post('/store', [CreatePackageController::class, 'store'])->name('admin.packages.store');
            Route::put('/{id}/update', [EditPackageController::class, 'update'])->name('admin.packages.update');
            Route::delete('/{id}/destroy', [DeletePackageController::class, 'destroy'])->name('admin.packages.destroy');
        });

        Route::prefix('orders')->group(function () {
            Route::get('/', [OrdersController::class, 'index'])->name('admin.orders');
            Route::get('/{booking}/details', [OrderDetailsController::class, 'index'])->name('admin.orders.show');
            Route::get('/{booking}/edit', [EditOrderController::class, 'index'])->name('admin.orders.edit');
            Route::get('/create', [CreateBookingController::class, 'index'])->name('admin.orders.create');
            Route::post('/store', [CreateBookingController::class, 'store'])->name('admin.orders.store');
            Route::put('/{id}/update', [EditOrderController::class, 'update'])->name('admin.orders.update');
            Route::patch('/{id}/status/update', [EditOrderStatusController::class, 'update'])->name('admin.orders.status.update');
            Route::delete('/{id}/destroy', [DeleteOrderController::class, 'destroy'])->name('admin.orders.destroy');

            //
            Route::get('/export', [ExportOrdersController::class, 'export'])->name('admin.orders.export');
        });


        Route::prefix('payments')->group(function () {
            Route::get('/{booking}/create', [CreatePaymentController::class, 'index'])->name('admin.payments.create');
            Route::get('/{booking}/print', [PrintController::class, 'index'])->name('admin.orders.print');
            Route::post('/store', [CreatePaymentController::class, 'store'])->name('admin.payments.store');
            Route::delete('/{id}/destroy', [DeletePaymentController::class, 'destroy'])->name('admin.payments.destroy');
        });
    });
});
