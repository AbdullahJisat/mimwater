<?php

use App\Http\Controllers\Admin\TeamController;
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