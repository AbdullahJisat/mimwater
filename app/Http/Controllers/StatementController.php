<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Dealer;
use App\Models\Retailer;
use App\Models\Statement;
use App\Models\StockItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;

class StatementController extends Controller
{
    public function __construct(Statement $statement, Dealer $dealer, Retailer $retailer)
    {
        $this->statement = $statement;
        $this->dealer = $dealer;
        $this->retailer = $retailer;
    }

    public function index(Request $request)
    {
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        $dealerDue = Statement::whereDealerId($request->dealer_id)->whereBetween('created_at', [$start, $end])->latest()->pluck('due')->first();

        $dealerStock = Statement::whereDealerId($request->dealer_id)->whereBetween('created_at', [$start, $end])->latest()->pluck('stock')->first();

        return view('backend.pages.report.profit-report')->with(['dealerStock' => $dealerStock, 'dealerDue' => $dealerDue, 'dealer' => $this->dealer->whereHas('statements')->with(['statements' => function ($q) use ($request, $start, $end) {
            $q->whereBetween('created_at', [$start, $end])->get();
        }])->findOrFail($request->dealer_id), 'start' => $start->format('d-M-Y'), 'end' => $end->format('d-M-Y')]);
    }

    public function create()
    {
        return view('backend.pages.report.statement-form');
    }

    public function indexRetailer(Request $request)
    {
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        $retailerDue = Statement::whereRetailerId($request->retailer_id)->whereBetween('created_at', [$start, $end])->latest()->pluck('due')->first();

        $retailerStock = Statement::whereRetailerId($request->retailer_id)->whereBetween('created_at', [$start, $end])->latest()->pluck('stock')->first();

        return view('backend.pages.report.retailer-statement-report')->with(['retailerStock' => $retailerStock, 'retailerDue' => $retailerDue, 'retailer' => $this->retailer->whereHas('statements')->with(['statements' => function ($q) use ($request, $start, $end) {
            $q->whereBetween('created_at', [$start, $end])->get();
        }])->findOrFail($request->retailer_id), 'start' => $start->format('d-M-Y'), 'end' => $end->format('d-M-Y')]);
    }

    public function createRetailer()
    {
        return view('backend.pages.report.retailer-statement-form');
    }

    public function store(Request $request)
    {
        $this->statement->create($request->validated());
        return redirect()->route('statements.index');
    }

    public function edit($id)
    {
        $statement = $this->statement->findOrFail($id);
        return view('backend.pages.statement.create', compact('statement'));
    }

    public function update(Request $request, $id)
    {
        $this->statement->findOrFail($id)->update($request->validated());
        return redirect()->route('statements.index');
    }

    public function destroy($id)
    {
        $this->statement->findOrFail($id)->delete();
        return back();
    }

    public function dailyDealerStatement(){
        $dailyStatement = Statement::with('dealer')->whereDate('created_at', Carbon::today())->get()->unique('dealer_id');
        return view('backend.pages.statement.daily-dealer', compact('dailyStatement'));
    }

    public function dateDealerStatement(Request $request)
    {
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();
        $dailyStatement = Statement::with('dealer')->whereBetween('created_at', [$start, $end])->get();
        return view('backend.pages.statement.daily-dealer', compact('dailyStatement', 'start', 'end'));

    }
    public function dailySalesmanStatement(){
        $dailyStatement = Statement::with('salesman')->whereDate('created_at', Carbon::today())->get()->unique('salesman_id');
        return view('backend.pages.statement.daily-Salesman', compact('dailyStatement'));
    }

    public function dateSalesmanStatement(Request $request)
    {
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();
        $dailyStatement = Statement::with('salesman')->whereBetween('created_at', [$start, $end])->get();
        return view('backend.pages.statement.daily-Salesman', compact('dailyStatement', 'start', 'end'));
    }
}



