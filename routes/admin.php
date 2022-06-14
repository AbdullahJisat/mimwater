<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DealerController;
use App\Http\Controllers\Admin\SalesmanController;
use App\Http\Controllers\Admin\DirectorController;
use App\Http\Controllers\Salesman\ItemController;
use App\Http\Controllers\Salesman\StockItemController;
use Illuminate\Support\Facades\Route;

// Route::name('admin.')->middleware('guest:admin')->group(function () {
//     // login route
//     Route::get('login', [LoginController::class, 'showLoginForm'])->name('show_login');
//     Route::post('login', [LoginController::class, 'login'])->name('login');
// });
// Route::middleware('auth:admin')->group(function () {
//     Route::get('/', function () {
//         return view('backend.layouts.master');
//     });
//     Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');

//     Route::resource('salesmans', SalesmanController::class);
//     Route::resource('dealers', DealerController::class);
//     Route::resource('costs', CostController::class);
//     Route::resource('items', ItemController::class);
//     Route::resource('stock-items', StockItemController::class);
//     Route::post('categories', [CostController::class, 'categoryStore'])->name('categories.store');
//     Route::get('report', [ReportController::class, 'getReport'])->name('getReport');
//     Route::resource('directors', DirectorController::class);
//     Route::resource('galleries', GalleryController::class);
//     Route::post('departments', [DirectorController::class, 'departmentStore'])->name('departments.store');
//     Route::post('designations', [DirectorController::class, 'designationStore'])->name('designations.store');
// });

// Route::resource('salesmans', SalesmanController::class)->middleware('web');
// Route::resource('dealers', DealerController::class)->middleware('web');
