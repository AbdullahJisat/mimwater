<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\StockOutItem;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentInvoiceController extends Controller
{
    public function __construct(StockOutItem $stockOutItem, Payment $payment)
    {
        $this->stockOutItem = $stockOutItem;
        $this->payment = $payment;
        view()->share(['items' => allItem(), 'retailers' => allRetailer()]);
    }

    public function index($id){
        $item = $this->stockOutItem->find($id);
        $dueCheck = Payment::whereRetailerId($item->retailer_id)->orWhere('payment_status',3)->latest()->first();
        return view('backend.pages.stock-item.invoice', compact('item', 'dueCheck'));
    }

    public function dealerInvoiceIndex($id){
        $item = $this->stockOutItem->find($id);
        $dueCheck = Payment::whereDealerId($item->dealer_id)->wherePaymentStatus(3)->sum('due');
        return view('backend.pages.stock-item.dealer-invoice', compact('item', 'dueCheck'));
    }

    public function dealerInvoiceStore(Request $request, $id){
        // dd($request->all());
        $request = new Request($request->all());
        $request->merge(['admin_id' => auth('admin')->user()->id, 'due' => $request->total - $request->due, 'amount' => $request->due]);
        Payment::create($request->except('_token'));
        return redirect()->route('invoices.dealer_dues');
    }


    public function store(Request $request, $id){
        $request = new Request($request->all());
        $request->merge(['salesman_id' => auth('salesman')->user()->id, 'due' => $request->total - $request->due, 'amount' => $request->due]);
        Payment::create($request->except('_token'));
        return redirect('report');
    }

    public function showDues(){
        $dues = Payment::with('retailer', 'salesman')->wherePaymentStatus(3)->whereNull('dealer_id')->get();
        $duesTotal = $dues->sum('due');
        return view('backend.pages.stock-out-item.due', ['dues' => $dues, 'duesTotal' => $duesTotal]);
    }

    public function showDealerDues(){
        $dues = Payment::wherePaymentStatus(3)->whereNull('retailer_id')->get();
        $duesTotal = $dues->sum('due');
        return view('backend.pages.stock-out-item.dealer-due', ['dues' => $dues, 'duesTotal' => $duesTotal]);
    }

    public function showDealerDuesDateFilter(Request $request){

        // $request->validate([
        //     'start' => 'required|date',
        //     'end' => 'required|date|before_or_equal:start',
        // ]);
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $dues = Payment::wherePaymentStatus(3)->whereNull('retailer_id')->whereBetween('created_at', [$start, $end])->get();
        dd($request->all());
        $duesTotal = $dues->sum('due');
        return view('backend.pages.stock-out-item.dealer-due', ['dues' => $dues, 'duesTotal' => $duesTotal]);
    }

    public function showDuesDateFilter(Request $request){

        // $request->validate([
        //     'start' => 'required|date',
        //     'end' => 'required|date|before_or_equal:start',
        // ]);
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $dues = Payment::wherePaymentStatus(3)->whereNull('dealer_id')->whereBetween('created_at', [$start, $end])->get();
        $duesTotal = $dues->sum('due');
        return view('backend.pages.stock-out-item.dealer-due', ['dues' => $dues, 'duesTotal' => $duesTotal]);
    }

    public function showCashes(){
        $cashes = Payment::with('retailer', 'salesman')->whereNull('dealer_id')->get();
        $cashesTotal = $cashes->sum('total');
        $duesTotal = $cashes->sum('due');
        $amountTotal = $cashes->sum('amount');
        return view('backend.pages.stock-out-item.cash', ['cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
    }

    public function showCashesDateFilter(Request $request){
        // $request->validate([
        //     'start' => 'required|date',
        //     'end' => 'required|date|before_or_equal:start',
        // ]);
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);

        $cashes = Payment::whereNull('dealer_id')->whereBetween('created_at', [$start, $end])->get();
        $cashesTotal = $cashes->sum('total');
        $duesTotal = $cashes->sum('due');
        $amountTotal = $cashes->sum('amount');
        return view('backend.pages.stock-out-item.dealer-cash', ['cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
    }

    public function showDealerCashes(){
        $cashes = Payment::whereNull('retailer_id')->get();
        $cashesTotal = $cashes->sum('total');
        $duesTotal = $cashes->sum('due');
        $amountTotal = $cashes->sum('amount');
        return view('backend.pages.stock-out-item.dealer-cash', ['cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
    }

    public function showDealerCashesDateFilter(Request $request){
        // $request->validate([
        //     'start' => 'required|date',
        //     'end' => 'required|date|before_or_equal:start',
        // ]);
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);

        $cashes = Payment::whereNull('retailer_id')->whereBetween('created_at', [$start, $end])->get();
        $cashesTotal = $cashes->sum('total');
        $duesTotal = $cashes->sum('due');
        $amountTotal = $cashes->sum('amount');
        return view('backend.pages.stock-out-item.dealer-cash', ['cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
    }

    public function showRetailerCashes(){
        $cashes = Payment::whereNull('dealer_id')->whereSalesmanId(auth('salesman')->user()->id)->get();
        $cashesTotal = $cashes->sum('total');
        $duesTotal = $cashes->sum('due');
        $amountTotal = $cashes->sum('amount');
        return view('backend.pages.stock-out-item.cash', ['cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
    }

    public function showRetailerDues(){
        $dues = Payment::with('retailer')->wherePaymentStatus(3)->whereNull('dealer_id')->whereSalesmanId(auth('salesman')->user()->id)->get();
        $duesTotal = $dues->sum('due');
        return view('backend.pages.stock-out-item.due', ['dues' => $dues, 'duesTotal' => $duesTotal]);
    }
}
