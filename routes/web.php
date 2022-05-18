<?php

use App\Http\Controllers\Admin\GallaryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TeamController;
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

Route::get('/dashboard', function () {
    return view('backend.layouts.master');
});


Auth::routes();


Route::get('/', function () {
    return view('frontend.index');
});


Route::prefix('team')->group(function(){
	Route::get('/add', [TeamController::class, 'addteam'])->name('team.add');
	Route::post('/store', [TeamController::class, 'storeteam'])->name('team.store');
	Route::get('/all-teams', [TeamController::class, 'teamlist'])->name('team.list');
	Route::get('/change_status/{id}', [TeamController::class, 'changeStatus']);
	Route::get('/delete/{id}', [TeamController::class, 'deleteteam']);
	Route::get('/edit/{id}', [TeamController::class, 'edit'])->name('team.edit');
	Route::post('/update/{id}', [TeamController::class, 'update'])->name('team.update');
});
Route::prefix('product')->group(function(){
	Route::get('/add', [ProductController::class, 'addproduct'])->name('product.add');
	Route::post('/store', [ProductController::class, 'storeproduct'])->name('product.store');
	Route::get('/all-products', [ProductController::class, 'productlist'])->name('product.list');
	Route::get('/change_status/{id}', [ProductController::class, 'changeStatus']);
	Route::get('/delete/{id}', [ProductController::class, 'deleteproduct']);
	Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
	Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
});
Route::prefix('gallary')->group(function(){
	Route::get('/add', [GallaryController::class, 'addgallary'])->name('gallary.add');
	Route::post('/store', [GallaryController::class, 'storegallary'])->name('gallary.store');
	Route::get('/all-gallarys', [GallaryController::class, 'gallarylist'])->name('gallary.list');
	Route::get('/change_status/{id}', [GallaryController::class, 'changeStatus']);
	Route::get('/delete/{id}', [GallaryController::class, 'deletegallary']);
	Route::get('/edit/{id}', [GallaryController::class, 'edit'])->name('gallary.edit');
	Route::post('/update/{id}', [GallaryController::class, 'update'])->name('gallary.update');
});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
