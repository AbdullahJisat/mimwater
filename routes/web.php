<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CostController;
use App\Http\Controllers\Admin\DealerController;
use App\Http\Controllers\Admin\DirectorController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProductionFacilitiesController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SalesmanController;
use App\Http\Controllers\Frontend\UIController;
use App\Http\Controllers\PaymentInvoiceController;
use App\Http\Controllers\Salesman\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Salesman\ItemController;
use App\Http\Controllers\Salesman\RequestBottleController;
use App\Http\Controllers\Salesman\RetailerController;
use App\Http\Controllers\Salesman\StockItemController;
use App\Http\Controllers\Salesman\StockOutItemController;
use Illuminate\Support\Facades\Route;

// UI prefix
Route::get('/', [UIController::class, 'index'])->name('index');
Route::get('overview', [UIController::class, 'overview'])->name('overview');
Route::get('ceo-message', [UIController::class, 'ceoMsg'])->name('ceo_message');
Route::get('chief-message', [UIController::class, 'chiefMsg'])->name('chief_message');
Route::get('directors', [UIController::class, 'directors'])->name('directors');
Route::get('products', [UIController::class, 'products'])->name('products');
Route::get('quality-assurance', [UIController::class, 'qualityAssurance'])->name('quality_assurance');
Route::get('galleries', [UIController::class, 'gallery'])->name('gallery');
Route::get('news-events', [UIController::class, 'newsEvent'])->name('news_event');
Route::get('career', [UIController::class, 'career'])->name('career');
Route::get('contact', [UIController::class, 'contact'])->name('contact');
Route::get('invoice', [UIController::class, 'invoice'])->name('invoice');
Route::get('invoice-details/{id}', [UIController::class, 'invoice'])->name('invoice-details')->where('id', '[0-9]+');


Route::group(['middleware' => 'auth:admin,dealer,retailer,salesman'], function() {
    Route::get('report', [ReportController::class, 'getReport'])->name('getReport');
    Route::get('dues', [PaymentInvoiceController::class, 'showDues'])->name('invoices.dues');
    Route::get('cashes', [PaymentInvoiceController::class, 'showCashes'])->name('invoices.cashes');
});
Route::group(['middleware' => 'auth:admin'], function() {
    Route::get('dealer-dues', [PaymentInvoiceController::class, 'showDealerDues'])->name('invoices.dealer_dues');
    Route::get('dealer-cashes', [PaymentInvoiceController::class, 'showDealerCashes'])->name('invoices.dealer_cashes');
    Route::get('admin/stock-out-items', [StockOutItemController::class, 'indexDealer'])->name('admin.index_stockOut_dealer');
    Route::post('admin/store/stock-out-items', [StockOutItemController::class, 'stockOutDealer'])->name('stock_out_dealer');
    Route::get('admin/stock-items', [StockItemController::class, 'indexStockDealer'])->name('admin.index_stock_dealer');
    Route::post('admin/store/stock-items', [StockItemController::class, 'stockDealer'])->name('stock_dealer');
    Route::get('admin/dealer/request', [RequestBottleController::class, 'dealerRequest'])->name('dealer_request');
});
// Admin prefix
Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    // login route
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('show_login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('dashboard', function () {
        return view('backend.layouts.master');
    });
    Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::resource('salesmans', SalesmanController::class);
    Route::resource('retailers', RetailerController::class);
    Route::resource('dealers', DealerController::class);
    Route::resource('costs', CostController::class);
    Route::resource('items', ItemController::class);
    Route::resource('stock-items', StockItemController::class);
    Route::post('categories', [CostController::class, 'categoryStore'])->name('categories.store');
    Route::resource('directors', DirectorController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('production-facilities', ProductionFacilitiesController::class);
    Route::post('departments', [DirectorController::class, 'departmentStore'])->name('departments.store');
    Route::post('designations', [DirectorController::class, 'designationStore'])->name('designations.store');
});

// Salesman prefix
Route::middleware('guest:salesman')->prefix('salesmans')->name('salesman.')->group(function () {
    // login route
    Route::get('login', [App\Http\Controllers\Salesman\Auth\LoginController::class, 'showLoginForm'])->name('show_login');
    Route::post('login', [App\Http\Controllers\Salesman\Auth\LoginController::class, 'login'])->name('login');
});
Route::prefix('salesmans')->middleware('auth:salesman')->group(function () {
    Route::get('dashboard', function () {
        return view('backend.layouts.master');
    });
    Route::post('logout', [App\Http\Controllers\Salesman\Auth\LoginController::class, 'logout'])->name('salesman.logout');

    Route::get('/', function () {
        return view('backend.layouts.master', ['url' => 'salesmans']);
    });

    Route::resource('retailers', RetailerController::class);
    Route::resource('items', ItemController::class);
    Route::resource('stock-items', StockItemController::class);
    Route::get('request-bottle', [RequestBottleController::class, 'index'])->name('request_bottles.index');
    Route::post('request-bottle/create', [RequestBottleController::class, 'store'])->name('request_bottles.store');
    Route::resource('stock-out-items', StockOutItemController::class);
    Route::post('categories', [CostController::class, 'categoryStore'])->name('categories.store');
    Route::get('invoices/{id}', [PaymentInvoiceController::class, 'index'])->name('invoices.index');
    Route::post('invoices/{id}', [PaymentInvoiceController::class, 'store'])->name('invoices.store');
});

// Dealer prefix
Route::middleware('guest:dealer')->prefix('dealers')->name('dealer.')->group(function () {
    // login route
    Route::get('login', [App\Http\Controllers\Dealer\Auth\LoginController::class, 'showLoginForm'])->name('show_login');
    Route::post('login', [App\Http\Controllers\Dealer\Auth\LoginController::class, 'login'])->name('login');
});
Route::prefix('dealers')->middleware('auth:dealer')->name('dealer.')->group(function () {
    Route::get('dashboard', function () {
        return view('backend.layouts.master');
    });
    Route::post('logout', [App\Http\Controllers\Dealer\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('backend.layouts.master', ['url' => 'dealers']);
    });
    Route::resource('stock-items', StockItemController::class);
    Route::get('request-bottle', [RequestBottleController::class, 'index'])->name('request_bottles.index');
    Route::post('request-bottle/create', [RequestBottleController::class, 'store'])->name('request_bottles.store');
    Route::get('dues', [PaymentInvoiceController::class, 'showDues'])->name('invoices.dues');
});

// Retailer prefix
Route::middleware('guest:retailer')->prefix('retailers')->name('retailer.')->group(function () {
    // login route
    Route::get('login', [App\Http\Controllers\Retailer\Auth\LoginController::class, 'showLoginForm'])->name('show_login');
    Route::post('login', [App\Http\Controllers\Retailer\Auth\LoginController::class, 'login'])->name('login');
});
Route::prefix('retailers')->middleware('auth:retailer')->name('retailer.')->group(function () {
    Route::get('dashboard', function () {
        return view('backend.layouts.master');
    });
    Route::post('logout', [App\Http\Controllers\Retailer\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('backend.layouts.master', ['url' => 'retailers']);
    });
    Route::resource('stock-items', StockItemController::class);
    Route::get('request-bottle', [RequestBottleController::class, 'index'])->name('request_bottles.index');
    Route::post('request-bottle/create', [RequestBottleController::class, 'store'])->name('request_bottles.store');
    Route::get('dues', [PaymentInvoiceController::class, 'showDues'])->name('invoices.dues');
});
