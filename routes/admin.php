<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DealerController;
use App\Http\Controllers\Admin\SalesmanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::namespace('Admin')->name('admin.')->group(function () {
    Route::namespace('Auth')->middleware('guest:admin')->group(function () {
        // login route
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('show_login')->middleware('web');
        Route::post('login', [LoginController::class, 'login'])->name('login');
    });
    Route::middleware('admin')->group(function () {
        Route::get('/', function () {
            return view('backend.layouts.master');
        });
    });
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

// Route::resource('salesmans', SalesmanController::class)->middleware('web');
// Route::resource('dealers', DealerController::class)->middleware('web');
