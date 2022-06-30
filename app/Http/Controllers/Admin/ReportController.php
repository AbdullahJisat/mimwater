<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Cost;
use App\Models\Payment;
use App\Models\Salesman;
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
        return view('backend.pages.report.index', compact('dealerIncome', 'retailerIncome', 'income', 'expense', 'salesmans', 'costs', 'totalProfit'));
    }

    public function showReportDateFilter(Request $request){
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $costs = Cost::with('category')->whereBetween('created_at', [$start, $end])->get();

            $dealerIncome = Payment::whereNull('retailer_id')->whereBetween('created_at', [$start, $end])->sum('amount');
            $retailerIncome = Payment::whereNull('dealer_id')->whereBetween('created_at', [$start, $end])->sum('amount');

            $income = $dealerIncome + $retailerIncome ?? 0;
            $expense = $this->cost
            // whereDate('created_at', Carbon::today()->subDays(30))->
            ->whereBetween('created_at', [$start, $end])
            ->sum('amount');
            $totalProfit = $income - $expense;
            $salesmans = '';
            $start = $start;
            $end = $end;
            return view('backend.pages.report.index', compact('start', 'end', 'dealerIncome', 'retailerIncome', 'income', 'expense', 'salesmans', 'costs', 'totalProfit'));
        }else {
            return back()->with('date older');
        }
        //


    }
}


// select * from `salesmen` where exists (select * from `stock_items` inner join `retailers` on `retailers`.`id` = `stock_items`.`retailer_id` where `salesmen`.`id` = `retailers`.`salesman_id` and date(`stockItemPrices`.`created_at`) = 2022-05-05)
