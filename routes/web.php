<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SalesOrderController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('customers', CustomerController::class);
Route::resource('items', ItemController::class);
Route::get('sales-orders', [SalesOrderController::class, 'index'])->name('sales-orders.index');
Route::get('sales-orders/create', [SalesOrderController::class, 'create'])->name('sales-orders.create');
Route::post('sales-orders', [SalesOrderController::class, 'store'])->name('sales-orders.store');
Route::get('sales-orders/{order}', [SalesOrderController::class, 'show'])->name('sales-orders.show');
Route::delete('sales-orders/{order}', [SalesOrderController::class, 'destroy'])->name('sales-orders.destroy');
