<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Cost;
use App\Models\DailyCashInHand;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\Salesman;
use App\Models\Statement;
use App\Models\StockItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct(StockItem $stockItem, Cost $cost, Salesman $salesman)
    {
        $this->stockItem = $stockItem;
        $this->cost = $cost;
        $this->salesman = $salesman;
    }

//     public function getReport(){
//         $date = Carbon::today()->subDays(30);
// //         dd(StockItem::selectRaw('sum(price) as s')->whereDate('created_at', Carbon::today())->get(),
// // StockItem::
// // // sum('price')
// // // selectRaw('sum(price) as s')
// // whereDate('created_at','>=',$date)->sum('price')
// //     );
//         // $incomeDetails = $this->stockItem->with('salesman')->get();
//         // dd($incomeDetails);

//         // $salesmans = $this->salesman->with(['stockItemPrices' => function ($query) {
//         //     $query->whereDate('created_at', Carbon::today());
//         // }], 'stockItemPrices.retailer')->get();
//         // $salesmans = DB::table('salesmen')->join('retailers','retailers.salesman_id','=','salesmen.id')->join('stock_items','stock_items.retailer_id','=','retailers.id')
//         // // ->whereDate('stock_items.created_at', $date)
//         // ->paginate(5);
//         // $salesmans = Salesman::with('stockItemPrices', 'stockItemPrices.item', 'payments')->whereHas('stockItemPrices' ,function($query) use($date) {
//         //     $query->whereNotNull('stock_items.item_id');
//         //     // whereDate('stock_items.created_at', $date);
//         // })->paginate(1);

//         // $salesmans = Salesman::with('stockItemPrices', 'stockItemPrices.item', 'payments')->whereHas('payments' ,function($query) {
//         //     $query->select('retailer_id',DB::raw('SUM(amount) as total_cash'))->with('dealer')->groupBy('retailer_id')->get();
//         //     // whereDate('stock_items.created_at', $date);
//         // })->paginate(1);

//         // $admins = Admin::with('payments')->whereHas('payments' ,function($query) {
//         //     $query->select('dealer_id',DB::raw('SUM(amount) as total_cash'))->with('dealer')->groupBy('dealer_id')->get();
//         //     // whereDate('stock_items.created_at', $date);
//         // })->get();

//         $admins = DB::table('admins')
//         ->select('dealer_id',DB::raw('SUM(amount) as total_cash'))
//         ->join('payments', 'payments.admin_id', '=', 'admins.id')
//         ->groupBy('dealer_id')
//         ->get();

//         dd($admins);

//         // $dealerIncomes = Payment::with('dealer')->get()->groupBy('dealer_id');
//         // $dealerIncomes = Payment::with('dealer')->groupBy('dealer_id')->sum('amount');
//         $dealerIncomes = Payment::select('dealer_id',DB::raw('SUM(amount) as total_cash'))->with('dealer')->groupBy('dealer_id')->get();
//         // dd($dealerIncomes);

//         $costs = Cost::with('category')->get();
//         // $income = $this->stockItem->
//         // // whereDate('created_at', Carbon::today()->subDays(30))->
//         // sum('price');

//         $income = $dealerIncomes->sum('total_cash');
//         $expense = $this->cost->
//         // whereDate('created_at', Carbon::today()->subDays(30))->
//         sum('amount');
//         $totalProfit = $income - $expense;
//         return view('backend.pages.report.index', compact('dealerIncomes', 'income', 'expense', 'salesmans', 'costs', 'totalProfit'));
//     }

    public function getReport(){
        // $dealerIncomes = Payment::select('dealer_id',DB::raw('SUM(amount) as total_cash'))->with('dealer')->groupBy('dealer_id')->get();
        // dd($dealerIncomes);

        $costs = Cost::with('category')->whereDate('created_at', Carbon::today())->get();
        // $income = $this->stockItem->
        // // whereDate('created_at', Carbon::today()->subDays(30))->
        // sum('price');

        $dealerIncome = Payment::whereNull('retailer_id')->whereDate('created_at', Carbon::today())->sum('amount');
        $retailerIncome = Payment::whereNull('dealer_id')->whereDate('created_at', Carbon::today())->sum('amount');

        // if($retailerIncome != 0){
        //     $retailerIncome = $retailerIncome;
        // }else{
        //     $retailerIncome = 0;
        // }

        $income = $dealerIncome + $retailerIncome ?? 0;
        $expense = $this->cost
        // whereDate('created_at', Carbon::today()->subDays(30))->
        ->whereDate('created_at', Carbon::today())
        ->sum('amount');
        $totalProfit = $income - $expense;
        $salesmans = '';
        $loan = Loan::latest()->first();
        return view('backend.pages.report.index', compact('loan', 'dealerIncome', 'retailerIncome', 'income', 'expense', 'salesmans', 'costs', 'totalProfit'));
    }

    public function showReportDateFilter(Request $request){
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $costs = Cost::with('category')->whereBetween('created_at', [$start, $end])->get();

            $dealerIncome = Payment::whereNull('retailer_id')->whereBetween('created_at', [$start, $end])->sum('amount');
            $retailerIncome = Payment::whereNull('dealer_id')->whereBetween('created_at', [$start, $end])->sum('amount');

            $loan = Loan::latest()->first();
            $income = $dealerIncome + $retailerIncome + $loan->amount ?? 0;
            $expense = $this->cost
            // whereDate('created_at', Carbon::today()->subDays(30))->
            ->whereBetween('created_at', [$start, $end])
            ->sum('amount');
            $totalProfit = $income + $loan->amount - $expense;
            $salesmans = '';
            $start = $start;
            $end = $end;
            return view('backend.pages.report.index', compact('loan', 'start', 'end', 'dealerIncome', 'retailerIncome', 'income', 'expense', 'salesmans', 'costs', 'totalProfit'));
        }else {
            return back()->with('date older');
        }
        //


    }

    public function incomeReport(){
        $totalStock = Statement::whereDate('created_at', Carbon::today())->sum('out');
        $totalBill = Statement::whereDate('created_at', Carbon::today())->sum('bill');
        $cashIncome = Payment::
        whereDate('created_at', Carbon::today())->
        wherePaymentType(1)->sum('amount');
        $checkIncome = Payment::whereDate('created_at', Carbon::today())->wherePaymentType(2)->sum('amount');
        $bkashIncome = Payment::whereDate('created_at', Carbon::today())->wherePaymentType(3)->sum('amount');
        $bkashCeoIncome = Payment::whereDate('created_at', Carbon::today())->wherePaymentType(4)->sum('amount');
        $loan = Loan::whereDate('created_at', Carbon::today())->whereType(1)->sum('amount');

        $totalIncome = $cashIncome + $checkIncome + $bkashIncome + $bkashCeoIncome + $loan;
        $costs = Cost::whereDate('created_at', Carbon::today())->with('category')->get();
        $expense = $costs->sum('amount');
        $loanPay = Loan::whereDate('created_at', Carbon::today())->whereType(0)->sum('amount');
        $dailyCashInHand = DailyCashInHand::latest()->first();
        if (!empty($dailyCashInHand)) {
            $cashInHand = ($cashIncome + $loan) - ($expense + $loanPay) + $dailyCashInHand->amount;
        } else {
            $cashInHand = ($cashIncome + $loan) - ($expense + $loanPay);
        }
        // dd('cash income', $cashIncome, 'loan', $loan, 'expense', $expense, 'loanPay', $loanPay, 'total ex', $expense + $loanPay, $cashInHand);
        // dd(($cashIncome + $loan) - ($expense + $loanPay));


        return view('backend.pages.report.income', compact('totalStock', 'totalBill', 'loanPay', 'expense', 'costs', 'totalIncome', 'cashInHand', 'loan', 'cashIncome', 'checkIncome', 'bkashIncome', 'bkashCeoIncome'));
    }

    public function incomeReportByDate(Request $request)
    {
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $costs = Cost::with('category')->whereBetween('created_at', [$start, $end])->get();
            //
            $totalStock = Statement::whereBetween('created_at', [$start, $end])->sum('out');
            $totalBill = Statement::whereBetween('created_at', [$start, $end])->sum('bill');
            $cashIncome = Payment::whereBetween('created_at', [$start, $end])->wherePaymentType(1)->sum('amount');
            $checkIncome = Payment::whereBetween('created_at', [$start, $end])->wherePaymentType(2)->sum('amount');
            $bkashIncome = Payment::whereBetween('created_at', [$start, $end])->wherePaymentType(3)->sum('amount');
            $bkashCeoIncome = Payment::whereBetween('created_at', [$start, $end])->wherePaymentType(4)->sum('amount');
            $loan = Loan::whereBetween('created_at', [$start, $end])->whereType(1)->sum('amount');

            $totalIncome = $cashIncome + $checkIncome + $bkashIncome + $bkashCeoIncome + $loan;
            $costs = Cost::whereBetween('created_at', [$start, $end])->with('category')->get();
            $expense = $costs->sum('amount');
            $loanPay = Loan::whereBetween('created_at', [$start, $end])->whereType(0)->sum('amount');
            $dailyCashInHand = DailyCashInHand::latest()->first();
            if (!empty($dailyCashInHand)) {
                $cashInHand = ($cashIncome + $loan) - ($expense + $loanPay) + $dailyCashInHand->amount;
            } else {
                $cashInHand = ($cashIncome + $loan) - ($expense + $loanPay);
            }
            // dd('cash income', $cashIncome, 'loan', $loan, 'expense', $expense, 'loanPay', $loanPay, 'total ex', $expense + $loanPay, $cashInHand);
            // dd(($cashIncome + $loan) - ($expense + $loanPay));


            return view('backend.pages.report.income-by-date', compact('totalStock', 'totalBill', 'loanPay', 'expense', 'costs', 'totalIncome', 'cashInHand', 'loan', 'cashIncome', 'checkIncome', 'bkashIncome', 'bkashCeoIncome'));
        } else {
            return back()->with('date older');
        }
    }

    // public function dailyCashInHand(){
    //     $dailyCashesInHand = DailyCashInHand::all();
    //     return view('backend.pages.report.daily-cash', ['dailyCashesInHand' => $dailyCashesInHand]);
    // }

    public function profitReport()
    {
        $bill = StockItem::whereDate('created_at', today())->get();
        $cost = Cost::whereDate('created_at', today())->get();
        return view('backend.pages.report.profit-report', compact('bill', 'cost'));
    }
}


// select * from `salesmen` where exists (select * from `stock_items` inner join `retailers` on `retailers`.`id` = `stock_items`.`retailer_id` where `salesmen`.`id` = `retailers`.`salesman_id` and date(`stockItemPrices`.`created_at`) = 2022-05-05)


// fetch('https://jsonplaceholder.typicode.com/photos')
//   .then(response => response.json())
//   .then(json => console.log(json))

//  async function fetchMovies() {
//   await fetch('https://jsonplaceholder.typicode.com/photos')
//   .then(response => response.json())
//   .then(json => console.log(json))
// }

// console.log(fetchMovies());
