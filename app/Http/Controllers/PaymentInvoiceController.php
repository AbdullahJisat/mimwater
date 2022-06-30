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
        $dueCheck = Payment::with('retailer')->whereRetailerId($item->retailer_id)->orWhere('payment_status',3)->latest()->first();
        return view('backend.pages.stock-item.invoice', compact('item', 'dueCheck'));
    }

    public function dealerInvoiceIndex($id){
        $item = $this->stockOutItem->find($id);
        $dueCheck = Payment::whereDealerId($item->dealer_id)->orWhere('payment_status',3)->latest()->first();
        return view('backend.pages.stock-item.dealer-invoice', compact('item', 'dueCheck'));
    }

    public function dealerInvoiceStore(Request $request, $id){
        // dd($request->all());
        Payment::whereDealerId($request->dealer_id)->whereAdminId(auth('admin')->user()->id)->update(['due' => 0]);
        $request = new Request($request->all());
        $request->merge(['admin_id' => auth('admin')->user()->id, 'due' => $request->total - $request->due, 'amount' => $request->due]);
        Payment::create($request->except('_token'));
        return redirect()->route('invoices.dealer_cashes');
    }


    public function store(Request $request, $id){
        Payment::whereRetailerId($request->retailer_id)->whereSalesmanId(auth('salesman')->user()->id)->update(['due' => 0]);
        $request = new Request($request->all());
        $request->merge(['salesman_id' => auth('salesman')->user()->id, 'due' => $request->total - $request->due, 'amount' => $request->due]);
        Payment::create($request->except('_token'));
        return redirect('salesmans/retailer-cashes');
    }

    public function showDues(){
        $dues = Payment::with('retailer', 'salesman')->wherePaymentStatus(3)->whereNull('dealer_id')->whereDate('created_at', Carbon::today())->get();
        $duesTotal = $dues->sum('due');
        return view('backend.pages.stock-out-item.due', ['dues' => $dues, 'duesTotal' => $duesTotal]);
    }

    public function showDealerDuesReport(){
        $dues = Payment::with('dealer', 'admin')->whereNull('retailer_id')->whereDealerId(auth('dealer')->user()->id)->whereDate('created_at', Carbon::today())->get();
        $duesTotal = $dues->sum('due');
        return view('backend.pages.stock-out-item.dealer-due-report', ['dues' => $dues, 'duesTotal' => $duesTotal]);
    }

    public function showDealerDuesReportDateFilter(Request $request){
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $dues = Payment::with('dealer', 'admin')->whereNull('retailer_id')->whereDealerId(auth('dealer')->user()->id)->whereBetween('created_at', [$start, $end])->get();
            $duesTotal = $dues->sum('due');
            return view('backend.pages.stock-out-item.dealer-due-report', ['start' => $start, 'end' => $end, 'dues' => $dues, 'duesTotal' => $duesTotal]);
        }else {
            return back()->with('date older');
        }
    }

    public function showDealerCashesReport(){
        $cashes = Payment::with('dealer', 'admin')->whereNull('retailer_id')->whereDealerId(auth('dealer')->user()->id)->whereDate('created_at', Carbon::today())->get();
        $cashesTotal = $cashes->sum('total');
        $duesTotal = $cashes->sum('due');
        $amountTotal = $cashes->sum('amount');
        return view('backend.pages.stock-out-item.dealer-cash-report', ['cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
    }

    public function showDealerCashesReportDateFilter(Request $request){
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $cashes = Payment::with('dealer', 'admin')->whereNull('retailer_id')->whereDealerId(auth('dealer')->user()->id)->whereBetween('created_at', [$start, $end])->get();
            $cashesTotal = $cashes->sum('total');
            $duesTotal = $cashes->sum('due');
            $amountTotal = $cashes->sum('amount');
            return view('backend.pages.stock-out-item.dealer-cash-report', ['start' => $start, 'end' => $end, 'cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
        }else {
            return back()->with('date older');
        }
    }

    public function showRetailerDuesReport(){
        $dues = Payment::with('retailer', 'salesman')->whereNull('dealer_id')->whereRetailerId(auth('retailer')->user()->id)->where('due', '!=', 0)->whereDate('created_at', Carbon::today())->get();
        $duesTotal = $dues->sum('due');
        return view('backend.pages.stock-out-item.retailer-due-report', ['dues' => $dues, 'duesTotal' => $duesTotal]);
    }

    public function showRetailerDuesReportDateFilter(Request $request){
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $dues = Payment::with('retailer', 'salesman')->whereNull('dealer_id')->whereRetailerId(auth('retailer')->user()->id)->where('due', '!=', 0)->whereBetween('created_at', [$start, $end])->get();
            $duesTotal = $dues->sum('due');
            return view('backend.pages.stock-out-item.retailer-due-report', ['start' => $start, 'end' => $end, 'dues' => $dues, 'duesTotal' => $duesTotal]);
        }else {
            return back()->with('date older');
        }

    }

    public function showRetailerCashesReport(){
        $cashes = Payment::with('retailer', 'salesman')->whereNull('dealer_id')->whereRetailerId(auth('retailer')->user()->id)->whereDate('created_at', Carbon::today())->get();
        $cashesTotal = $cashes->sum('total');
        $duesTotal = $cashes->sum('due');
        $amountTotal = $cashes->sum('amount');
        return view('backend.pages.stock-out-item.retailer-cash-report', ['cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
    }

    public function showRetailerCashesReportDateFilter(Request $request){
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $cashes = Payment::with('retailer', 'salesman')->whereNull('dealer_id')->whereRetailerId(auth('retailer')->user()->id)->whereBetween('created_at', [$start, $end])->get();
            $cashesTotal = $cashes->sum('total');
            $duesTotal = $cashes->sum('due');
            $amountTotal = $cashes->sum('amount');
            return view('backend.pages.stock-out-item.retailer-cash-report', ['start' => $start, 'end' => $end, 'cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
        }else {
            return back()->with('date older');
        }

    }

    public function showDealerDues(){
        $dues = Payment::whereNull('retailer_id')->whereDate('created_at', Carbon::today())->get();
        $duesTotal = $dues->sum('due');
        return view('backend.pages.stock-out-item.dealer-due', ['dues' => $dues, 'duesTotal' => $duesTotal]);
    }

    public function showDealerDuesDateFilter(Request $request){
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $dues = Payment::whereNull('retailer_id')->whereBetween('created_at', [$start, $end])->get();
            $duesTotal = $dues->sum('due');
            return view('backend.pages.stock-out-item.dealer-due', ['start' => $start, 'end' => $end, 'dues' => $dues, 'duesTotal' => $duesTotal]);
        }else {
            return back()->with('date older');
        }
    }

    public function showDuesDateFilter(Request $request){

        // $request->validate([
        //     'start' => 'required|date',
        //     'end' => 'required|date|before_or_equal:start',
        // ]);
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $dues = Payment::whereNull('dealer_id')->whereBetween('created_at', [$start, $end])->get();
            $duesTotal = $dues->sum('due');
            return view('backend.pages.stock-out-item.due', ['start' => $start, 'end' => $end, 'dues' => $dues, 'duesTotal' => $duesTotal]);
        }else {
            return back()->with('date older');
        }
    }

    public function showCashes(){
        $cashes = Payment::with('retailer', 'salesman')->whereNull('dealer_id')->whereDate('created_at', Carbon::today())->get();
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
        // $start = Carbon::parse($request->start);
        // $end = Carbon::parse($request->end);

        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $cashes = Payment::with('retailer', 'salesman')->whereNull('dealer_id')->whereBetween('created_at', [$start, $end])->get();
            $cashesTotal = $cashes->sum('total');
            $duesTotal = $cashes->sum('due');
            $amountTotal = $cashes->sum('amount');
            return view('backend.pages.stock-out-item.cash', ['start' => $start, 'end' => $end, 'cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
        }else {
            return back()->with('date older');
        }

    }

    public function showDealerCashes(){
        $cashes = Payment::whereNull('retailer_id')->whereDate('created_at', Carbon::today())->get();
        $cashesTotal = $cashes->sum('total');
        $duesTotal = Payment::whereNull('retailer_id')->latest()->pluck('due')->first();
        $amountTotal = $cashes->sum('amount');
        return view('backend.pages.stock-out-item.dealer-cash', ['cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
    }

    public function showDealerCashesDateFilter(Request $request){
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $cashes = Payment::with('retailer', 'salesman')->whereNull('retailer_id')->whereBetween('created_at', [$start, $end])->get();
            $cashesTotal = $cashes->sum('total');
            $duesTotal = $cashes->sum('due');
            $amountTotal = $cashes->sum('amount');
            return view('backend.pages.stock-out-item.dealer-cash', ['start' => $start, 'end' => $end, 'cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
        }else {
            return back()->with('date older');
        }
    }

    public function showRetailerCashes(){
        $cashes = Payment::whereNull('dealer_id')->whereSalesmanId(auth('salesman')->user()->id)->whereDate('created_at', Carbon::today())->get();
        $cashesTotal = $cashes->sum('total');
        $duesTotal = $cashes->sum('due');
        $amountTotal = $cashes->sum('amount');
        return view('backend.pages.stock-out-item.cash', ['cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
    }

    public function showRetailerCashesDateFilter(Request $request){

        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $cashes = Payment::whereNull('dealer_id')->whereSalesmanId(auth('salesman')->user()->id)->whereBetween('created_at', [$start, $end])->get();
            $cashesTotal = $cashes->sum('total');
            $duesTotal = $cashes->sum('due');
            $amountTotal = $cashes->sum('amount');
            return view('backend.pages.stock-out-item.cash', ['start' => $start, 'end' => $end, 'cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
        }else {
            return back()->with('date older');
        }
    }

    public function showRetailerDues(){
        $dues = Payment::with('retailer')->whereNull('dealer_id')->whereSalesmanId(auth('salesman')->user()->id)->where('due', '!=' , 0)->whereDate('created_at', Carbon::today())->get();
        $duesTotal = $dues->sum('due');
        return view('backend.pages.stock-out-item.due', ['dues' => $dues, 'duesTotal' => $duesTotal]);
    }

    public function showRetailerDuesDateFilter(Request $request){

        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $dues = Payment::with('retailer')->whereNull('dealer_id')->whereSalesmanId(auth('salesman')->user()->id)->where('due', '!=' , 0)->whereBetween('created_at', [$start, $end])->get();
            $duesTotal = $dues->sum('due');
            return view('backend.pages.stock-out-item.due', ['start' => $start, 'end' => $end, 'dues' => $dues, 'duesTotal' => $duesTotal]);
        }else {
            return back()->with('date older');
        }
    }
}
