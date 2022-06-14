<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cost;
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

    public function getReport(){
        $date = Carbon::today()->subDays(30);
//         dd(StockItem::selectRaw('sum(price) as s')->whereDate('created_at', Carbon::today())->get(),
// StockItem::
// // sum('price')
// // selectRaw('sum(price) as s')
// whereDate('created_at','>=',$date)->sum('price')
//     );
        // $incomeDetails = $this->stockItem->with('salesman')->get();
        // dd($incomeDetails);

        // $salesmans = $this->salesman->with(['stockItemPrices' => function ($query) {
        //     $query->whereDate('created_at', Carbon::today());
        // }], 'stockItemPrices.retailer')->get();
        // $salesmans = DB::table('salesmen')->join('retailers','retailers.salesman_id','=','salesmen.id')->join('stock_items','stock_items.retailer_id','=','retailers.id')
        // // ->whereDate('stock_items.created_at', $date)
        // ->paginate(5);
        $salesmans = Salesman::with('stockItemPrices', 'stockItemPrices.item')->whereHas('stockItemPrices' ,function($query) use($date) {
            $query->whereNotNull('stock_items.item_id');
            // whereDate('stock_items.created_at', $date);
        })->paginate(1);

        $costs = Cost::with('category')->get();
        $income = $this->stockItem->
        // whereDate('created_at', Carbon::today()->subDays(30))->
        sum('price');
        $expense = $this->cost->
        // whereDate('created_at', Carbon::today()->subDays(30))->
        sum('amount');
        $totalProfit = $income - $expense;
        return view('backend.pages.report.index', compact('income', 'expense', 'salesmans', 'costs', 'totalProfit'));
    }
}


// select * from `salesmen` where exists (select * from `stock_items` inner join `retailers` on `retailers`.`id` = `stock_items`.`retailer_id` where `salesmen`.`id` = `retailers`.`salesman_id` and date(`stockItemPrices`.`created_at`) = 2022-05-05)
