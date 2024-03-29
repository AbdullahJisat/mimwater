<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ClientReviewController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CostController;
use App\Http\Controllers\Admin\DealerController;
use App\Http\Controllers\Admin\DirectorController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\OfficeController;
use App\Http\Controllers\Admin\NewsEventsController;
use App\Http\Controllers\Admin\ProductionFacilitiesController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\SalesmanController;
use App\Http\Controllers\DealerDueController;
use App\Http\Controllers\Frontend\UIController;
use App\Http\Controllers\PaymentInvoiceController;
use App\Http\Controllers\Salesman\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Manager\Auth\LoginController as ManagerLoginController;
use App\Http\Controllers\Office\Auth\LoginController as OfficeLoginController;
use App\Http\Controllers\Salesman\ItemController;
use App\Http\Controllers\Salesman\RequestBottleController;
use App\Http\Controllers\Salesman\RetailerController;
use App\Http\Controllers\Salesman\StockItemController;
use App\Http\Controllers\Salesman\StockOutItemController;
use App\Http\Controllers\StatementController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// UI prefix

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

Route::get('/', [UIController::class, 'index'])->name('index');
Route::get('statements', [StatementController::class, 'index'])->name('statement.index');
Route::get('statements-retailer', [StatementController::class, 'indexRetailer'])->name('statement.index_retailer');
Route::get('statements-form', [StatementController::class, 'create'])->name('statement.create');
Route::get('retailer-statements-form', [StatementController::class, 'createRetailer'])->name('statement.create_retailer');
// Route::get('cash-in-hand', ReportController::class)->name('cash_in_hand');
Route::get('profit-report', [App\Http\Controllers\Admin\ReportController::class, 'profitReport'])->name('profit_report');
Route::get('daily-dealer-statements', [StatementController::class, 'dailyDealerStatement'])->name('daily_dealer_statements');
Route::get('date-dealer-statements', [StatementController::class, 'dateDealerStatement'])->name('date_dealer_statements');

Route::get('daily-retailer-statements', [StatementController::class, 'dailyRetailerStatement'])->name('daily_retailer_statements');
Route::get('date-retailer-statements', [StatementController::class, 'dateRetailerStatement'])->name('date_retailer_statements');

Route::get('overview', [UIController::class, 'overview'])->name('overview');
Route::get('ceo-message', [UIController::class, 'ceoMsg'])->name('ceo_message');
Route::get('chief-message', [UIController::class, 'chiefMsg'])->name('chief_message');
Route::get('directors', [UIController::class, 'directors'])->name('directors');
Route::get('products', [UIController::class, 'products'])->name('products');
Route::get('quality-assurance', [UIController::class, 'qualityAssurance'])->name('quality_assurance');
Route::get('galleries', [UIController::class, 'gallery'])->name('gallery');
Route::get('production-facilities', [UIController::class, 'productionFacilities'])->name('production_facilities');
Route::get('news-events', [UIController::class, 'newsEvent'])->name('news_event');
Route::get('career', [UIController::class, 'career'])->name('career');
Route::get('contact', [UIController::class, 'contact'])->name('contact');
Route::post('contact-store', [ContactController::class, 'store'])->name('contact_store');
Route::get('invoice', [UIController::class, 'invoice'])->name('invoice');
Route::get('invoice-details/{id}', [UIController::class, 'invoice'])->name('invoice-details')->where('id', '[0-9]+');


Route::group(['middleware' => 'auth:admin,dealer,retailer,salesman,manager,office_user'], function () {
    Route::get('report', [ReportController::class, 'getReport'])->name('get_report');
    
    Route::get('show-report-date', [ReportController::class, 'showReportDateFilter'])->name('show_report_date');
    Route::get('dues', [PaymentInvoiceController::class, 'showDues'])->name('invoices.dues');
    Route::get('show-dues-date', [PaymentInvoiceController::class, 'showDuesDateFilter'])->name('show_dues_by_date');
    Route::get('cashes', [PaymentInvoiceController::class, 'showCashes'])->name('invoices.cashes');
    Route::get('show-cash-date', [PaymentInvoiceController::class, 'showCashesDateFilter'])->name('show_cash_by_date');
});

Route::group(['middleware' => 'auth:admin'], function () {

    Route::resource('admin/admins', AdminController::class);
    Route::resource('admin/managers', ManagerController::class);

    Route::prefix('admin/roles')->name('admin.role.')->group(function () {
        Route::get('', [RolePermissionController::class, 'index'])->name('index');
        Route::get('create', [RolePermissionController::class, 'create'])->name('create');
        Route::post('get-permissions-by-role-id/{id}', [RolePermissionController::class, 'getPermissionsByRoleId'])->name('get_permissions_by_role_id');
        Route::post('store', [RolePermissionController::class, 'store'])->name('store');
        Route::post('permission-store', [RolePermissionController::class, 'permissionStore'])->name('permission_store');
    });

    Route::post('stockout-billdealer', [StockOutItemController::class, 'stockOutBillDealer'])->name('stockout-billdealer');
    Route::get('dealer-invoices-stock-out/{id}', [PaymentInvoiceController::class, 'dealerInvoiceStockOutIndex'])->name('invoices.dealer_index_stock_out');
    Route::post('dealer-invoices-stock-out-store/{id}', [PaymentInvoiceController::class, 'dealerInvoiceStockOutStore'])->name('invoices.dealer_store_out');
    Route::post('daily_cash_hand_store', [PaymentInvoiceController::class, 'dailyCashHandStore'])->name('daily_cash_hand_store');




    Route::get('retailers-salesman/{id}', [SalesmanController::class, 'retailersBySalesman'])->name('retailers_salesman');
    Route::get('dealer-dues', [PaymentInvoiceController::class, 'showDealerDues'])->name('invoices.dealer_dues');
    Route::get('previous-dealer-dues/{id}', [PaymentInvoiceController::class, 'previousDealerDue'])->name('previous_dealer_dues');
    Route::post('dealer-dues-store', [PaymentInvoiceController::class, 'storeDealerDues'])->name('stock-out-items.dealer_due_store');

    Route::get('retailer-dues', [PaymentInvoiceController::class, 'showRetailerDues'])->name('retailer_dues');
    Route::get('previous-retailer-dues/{id}', [PaymentInvoiceController::class, 'previousRetailerDue'])->name('previous_retailer_dues');
    Route::post('retailer-dues-store', [PaymentInvoiceController::class, 'storeRetailerDues'])->name('stock-out-items.retailer_due_store');
    Route::get('retailer-dues-date', [PaymentInvoiceController::class, 'showRetailerDuesDateFilter'])->name('retailer_dues_date');
    Route::get('retailer-cashes', [PaymentInvoiceController::class, 'showRetailerCashes'])->name('retailer_cashes');
    Route::get('retailer-cashes-date', [PaymentInvoiceController::class, 'showRetailerCashesDateFilter'])->name('retailer_cashes_date');
    
    Route::get('show-dealer-dues-date', [PaymentInvoiceController::class, 'showDealerDuesDateFilter'])->name('show_dealer_dues_by_date');
    Route::get('dealer-cashes', [PaymentInvoiceController::class, 'showDealerCashes'])->name('invoices.dealer_cashes');
    Route::get('show-dealer-cash-date', [PaymentInvoiceController::class, 'showDealerCashesDateFilter'])->name('show_dealer_cash_by_date');
    Route::post('admin/store/stock-out-items', [StockOutItemController::class, 'stockOutDealer'])->name('stock_out_dealer');
    Route::get('admin/retailer-stock-items', [StockItemController::class, 'indexStockRetailer'])->name('admin.index_stock_retailer');
    Route::post('admin/store/stock-items', [StockItemController::class, 'stockDealer'])->name('stock_dealer');
    Route::post('admin/store/stock-in-items', [StockItemController::class, 'stockInDealer'])->name('stock_in_dealer');
    Route::post('admin/store-retailer/stock-items', [StockItemController::class, 'stockInRetailer'])->name('stock_retailer');
    Route::get('admin/dealer/request', [RequestBottleController::class, 'dealerRequest'])->name('dealer_request');

    Route::get('dealer-invoices/{id}', [PaymentInvoiceController::class, 'dealerInvoiceIndex'])->name('invoices.dealer_index');
    Route::post('dealer-invoices/{id}', [PaymentInvoiceController::class, 'dealerInvoiceStore'])->name('invoices.dealer_store');

    Route::get('income-report', [ReportController::class, 'incomeReport'])->name('income_report');
    Route::get('income-report-date', [ReportController::class, 'incomeReportByDate'])->name('income_report_date');

    Route::put('admin/update/{id}/dealer-stock-items', [StockItemController::class, 'updateDealerStock'])->name('update_dealer_stock');
    Route::get('admin/edit/{id}/dealer-stock-items', [StockItemController::class, 'editDealerStock'])->name('edit_dealer_stock');

    Route::put('admin/update/{id}/dealer-due', [DealerDueController::class, 'updateDealerDue'])->name('update_dealer_due');
    Route::get('admin/edit/{id}/dealer-due', [DealerDueController::class, 'editDealerDue'])->name('edit_dealer_due');
});

// Admin prefix
Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    // login route
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('show_login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});

Route::prefix('admin')->middleware(['auth:admin', 'prevent-back-history'])->group(function () {
    Route::get('dashboard', function () {
        return view('backend.layouts.partials._dashboard', ['loans' => \App\Models\Loan::all()]);
    });
    Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');
    Route::post('loans/store', [LoanController::class, 'store'])->name('loans.store');
    Route::post('loans/pay-store', [LoanController::class, 'payStore'])->name('loans.pay_store');
    Route::post('loans/delete/{id}', [LoanController::class, 'destroy'])->name('loans.destroy');

    Route::resource('salesmans', SalesmanController::class);
    Route::resource('items', ItemController::class);
    Route::resource('contacts', ContactController::class);
    Route::get('contact-read/{id}', [ContactController::class, 'contactRead'])->name('contact_read');
    Route::resource('clients', ClientController::class);
    Route::resource('client-reviews', ClientReviewController::class);
    Route::get('retailers', function () {
        return view('backend.pages.retailer.admin_index', ['retailers' => allRetailer()]);
    })->name('admin_retailers');
    Route::resource('items', ItemController::class);
    Route::post('categories', [CostController::class, 'categoryStore'])->name('categories.store');
    Route::resource('directors', DirectorController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('production-facilities', ProductionFacilitiesController::class);
    Route::resource('news-events', NewsEventsController::class);
    Route::post('departments', [DirectorController::class, 'departmentStore'])->name('departments.store');
    Route::post('designations', [DirectorController::class, 'designationStore'])->name('designations.store');
    Route::get('stock-item-quantity/{itemId}/{userId}', [StockOutItemController::class, 'stockByItem'])->name('stock_by_item');

});

Route::group(['middleware' => 'auth:admin,office_user'], function () {
  
     Route::get('loans', [LoanController::class, 'index'])->name('loans.index');
    Route::get('loans-report', [LoanController::class, 'loanReport'])->name('loans.report');
    Route::get('pay-loans', [LoanController::class, 'payIndex'])->name('loans.pay_index');


    Route::resource('dealers', DealerController::class);
    Route::resource('costs', CostController::class);
    Route::resource('stock-items', StockItemController::class);
    // Route::resource('news-events', NewsEventsController::class);
    Route::get('stock-item-quantity/{itemId}/{userId}', [StockOutItemController::class, 'stockByItem'])->name('stock_by_item');
});

Route::group(['middleware' => 'auth:admin,office_user,manager'], function () {
  
    Route::get('admin/dealer-stock-out-items', [StockOutItemController::class, 'indexDealer'])->name('admin.index_stockOut_dealer');
    Route::get('admin/dealer-stock-items', [StockItemController::class, 'indexStockDealer'])->name('admin.index_stock_dealer');
    
    Route::get('income-report', [ReportController::class, 'incomeReport'])->name('income_report');
    Route::get('income-report-date', [ReportController::class, 'incomeReportByDate'])->name('income_report_date');
    Route::get('dealer-dues', [PaymentInvoiceController::class, 'showDealerDues'])->name('invoices.dealer_dues');
    Route::get('dealer-cashes', [PaymentInvoiceController::class, 'showDealerCashes'])->name('invoices.dealer_cashes');
});


// Manager Prefix
Route::middleware('guest:manager')->prefix('manager')->name('manager.')->group(function () {
    // login route
    Route::get('login', [ManagerLoginController::class, 'showLoginForm'])->name('show_login');
    Route::post('login', [ManagerLoginController::class, 'login'])->name('login');
});
Route::prefix('managers')->middleware('auth:manager')->name('manager.')->group(function () {
    Route::get('dashboard', function () {
        return view('backend.layouts.master');
    });
    Route::post('logout', [App\Http\Controllers\Manager\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('backend.layouts.master', ['url' => 'managers']);
    });
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
    Route::resource('stock-items', StockItemController::class);
    Route::get('request-bottle', [RequestBottleController::class, 'index'])->name('request_bottles.index');
    Route::post('request-bottle/create', [RequestBottleController::class, 'store'])->name('request_bottles.store');
    Route::resource('stock-out-items', StockOutItemController::class);
    Route::post('categories', [CostController::class, 'categoryStore'])->name('categories.store');
    Route::get('invoices/{id}', [PaymentInvoiceController::class, 'index'])->name('invoices.index');
    Route::post('invoices/{id}', [PaymentInvoiceController::class, 'store'])->name('invoices.store');

    Route::get('retailer-stock-item-quantity/{itemId}/{userId}', [StockOutItemController::class, 'retailerStockByItem'])->name('retailer_stock_by_item');
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
    Route::get('dues-report', [PaymentInvoiceController::class, 'showDealerDuesReport'])->name('invoices.dues_report');
    Route::get('dues-report-date', [PaymentInvoiceController::class, 'showDealerDuesReportDateFilter'])->name('invoices.dues_report_date');
    Route::get('cash-report', [PaymentInvoiceController::class, 'showDealerCashesReport'])->name('invoices.cash_report');
    Route::get('cashes-report-date', [PaymentInvoiceController::class, 'showDealerCashesReportDateFilter'])->name('invoices.cashes_report_date');
});


// Office_User prefix


Route::middleware('guest:office_user')->prefix('office_user')->name('office_user.')->group(function () {
    // login route
    Route::get('login', [OfficeLoginController::class, 'showLoginForm'])->name('show_login');
    Route::post('login', [OfficeLoginController::class, 'login'])->name('login');
});

Route::prefix('office_users')->middleware(['auth:office_user', 'prevent-back-history'])->group(function () {
    Route::get('dashboard', function () {
        return view('backend.layouts.partials._dashboard', ['loans' => \App\Models\Loan::all()]);
    });
    Route::post('logout', [LoginController::class, 'logout'])->name('office_user.logout');


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
    Route::get('dues-report', [PaymentInvoiceController::class, 'showRetailerDuesReport'])->name('invoices.dues_report');
    Route::get('dues-report-date', [PaymentInvoiceController::class, 'showRetailerDuesReportDateFilter'])->name('invoices.dues_report_date');
    Route::get('cash-report', [PaymentInvoiceController::class, 'showRetailerCashesReport'])->name('invoices.cash_report');
    Route::get('cashes-report-date', [PaymentInvoiceController::class, 'showRetailerCashesReportDateFilter'])->name('invoices.cashes_report_date');
});

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);


Route::get('clear_cache', function () {
    Artisan::call('cache:clear');
    dd("Cache is cleared");
});

Route::get('clear_config', function () {
    Artisan::call('config:cache');
    dd("Config is cleared");
});

Route::get('key', function () {
    Artisan::call('key:generate');
    dd("key");
});

Route::get('optimize', function () {
    Artisan::call('optimize:clear');
    dd("optimize");
});

Route::get('route', function () {
    Artisan::call('route:clear');
    dd("route");
});

Route::get('view', function () {
    Artisan::call('view:clear');
    dd("view");
});

Route::get('config', function () {
    Artisan::call('config:clear');
    dd("config");
});

Route::get('storage', function () {
    Artisan::call('storage:link');
    dd("storage");
});