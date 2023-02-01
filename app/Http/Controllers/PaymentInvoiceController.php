<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\Payment;
use App\Models\Statement;
use App\Models\StockItem;
use App\Models\StockOutItem;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentInvoiceController extends Controller
{
    public function __construct(StockOutItem $stockOutItem, Payment $payment)
    {
        $this->stockOutItem = $stockOutItem;
        $this->payment = $payment;
        view()->share(['items' => allItem(), 'retailers' => allRetailer(), 'dealers' => allDealer()]);
    }

    public function index($id){
        $item = $this->stockOutItem->find($id);
        $stockItemTotalPrice = StockItem::whereRetailerId($item->retailer_id)->whereItemId($item->item_id)->latest()->pluck('temp_total')->first();
        // dd($stockItemTotalPrice);
        $dueCheck = Payment::with('retailer')->whereRetailerId($item->retailer_id)->orWhere('payment_status',3)->latest()->first();

        $due = StockItem::whereRetailerId($item->retailer_id)->whereItemId($item->item_id)->latest()->pluck('temp_total')->first();
        return view('backend.pages.stock-item.invoice', compact('item', 'dueCheck', 'stockItemTotalPrice', 'due'));
    }

    public function dealerInvoiceIndex($id){
        $item = $this->stockOutItem->find($id);
        $stockItemTotalPrice = StockItem::whereDealerId($item->dealer_id)->whereItemId($item->item_id)->latest()->pluck('temp_total')->first();
        // dd($stockItemTotalPrice);
        $dueCheck = Payment::whereDealerId($item->dealer_id)->orWhere('payment_status',3)->latest()->first();

        $due = StockItem::whereDealerId($item->dealer_id)->whereItemId($item->item_id)->latest()->pluck('temp_total')->first();
        return view('backend.pages.stock-item.dealer-invoice', compact('item', 'dueCheck', 'stockItemTotalPrice', 'due'));
    }

    public function dealerInvoiceStore(Request $request, $id){
            DB::transaction(function () use ($request, $id) {
                if ($request->action == 'pay') {
                    $item = $this->stockOutItem->find($id);
                    $user = Dealer::find($request->dealer_id);
                    // dd($request->all());
                    // Payment::whereDealerId($request->dealer_id)->whereAdminId(auth('admin')->user()->id)->update(['due' => 0]);
                    $request = new Request($request->all());


                    if ($request->totalDue == 0) {
                        $request->merge(['admin_id' => auth('admin')->user()->id, 'due' => $request->total - $request->due, 'amount' => $request->due, 'total' => $request->total]);
                    } else {
                        $request->merge(['admin_id' => auth('admin')->user()->id, 'due' => $request->totalDue - $request->due, 'amount' => $request->due, 'total' => $request->total]);
                    }

                    // $preDue = Payment::whereDealerId($request->dealer_id)->latest()->pluck('due')->first();
                    $preQuantity = Statement::whereDealerId($request->dealer_id)->latest()->first();
                        $statement = new Statement();
                        $statement->out = $request->quantity;
                        $statement->dealer_id = $request->dealer_id;
                        $statement->admin_id = auth('admin')->user()->id;
                        $statement->stock = abs($request->quantity - $preQuantity->in);
                        $statement->rate = $user->price;
                        dd($request->due);
                    if ($request->due != '') {
                        $statement->payment = $request->due;
                        $statement->due = abs($request->due - $preQuantity->due);
                    } else {
                        $statement->bill = $request->due;
                        $statement->due = abs($request->due + $preQuantity->due);
                    }
                    $statement->save();

                    Payment::create($request->except('_token', 'totalDue', 'action'));
                    $stockItem = StockItem::whereDealerId($request->dealer_id)->whereItemId($request->item_id)->latest()->first();
                    $temp_total = $stockItem->price - $request->due;
                    // dd($request->all(), $stockItem->price, $request->due, $temp_total);
                    $stockItem->update(['temp_total' => $temp_total]);
                } else {
                    $item = $this->stockOutItem->find($id);
                    $item->delete();
                }
            });
        // catch (\Throwable $e) {
        //     DB::rollback();
        //     throw $e;
        // }
        return redirect()->route('invoices.dealer_cashes');
    }


    public function store(Request $request, $id){
        // Payment::whereRetailerId($request->retailer_id)->whereSalesmanId(auth('salesman')->user()->id)->update(['due' => 0]);
        $request = new Request($request->all());
        if ($request->totalDue == 0) {
            $request->merge(['salesman_id' => auth('salesman')->user()->id, 'due' => $request->total - $request->due, 'amount' => $request->due, 'total' => $request->total]);
            // dd('totalDue 0',  $request->all());
        } else {
            $request->merge(['salesman_id' => auth('salesman')->user()->id, 'due' => $request->totalDue - $request->due, 'amount' => $request->due, 'total' => $request->total]);
            // dd($request->all());
        }
        Payment::create($request->except('_token', 'totalDue'));
        $stockItem = StockItem::whereRetailerId($request->retailer_id)->whereItemId($request->item_id)->latest()->first();
        $temp_total = $stockItem->price - $request->due;
        // dd($request->all(), $stockItem->price, $request->due, $temp_total);
        $stockItem->update(['temp_total' => $request->due]);
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
        $dues = Payment::whereNull('retailer_id')->whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->get()->unique('dealer_id');;
        $duesTotal = $dues->sum('due');
        return view('backend.pages.stock-out-item.dealer-due', ['dues' => $dues, 'duesTotal' => $duesTotal, 'dealers' => allDealer()]);
    }

    public function storeDealerDues(Request $request){
        $due = Payment::whereNull('retailer_id')->whereDealerId($request->dealer_id)->orderBy('created_at', 'desc')->first();
        if (!empty($due)){
            $request = new Request($request->all());
            $request->merge(['due' => $due->due - $request->due, 'admin_id' => auth('admin')->user()->id]);
        }
        $request = new Request($request->all());
        $request->merge(['admin_id' => auth('admin')->user()->id]);
        Payment::create($request->all());
        return back();
    }

    public function previousDealerDue($id){
        $due = Payment::whereNull('retailer_id')->whereDealerId($id)->orderBy('created_at', 'desc')->first();
        return $due;
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
        $cashes = Payment::whereNull('dealer_id')->whereSalesmanId(auth('salesman')->user()->id)->whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->get()->unique('retailer_id');
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
        $dues = Payment::with('retailer')->whereNull('dealer_id')->whereSalesmanId(auth('salesman')->user()->id)->whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->get()->unique('retailer_id');
        // ->groupBy('retailer_id')->latest('created_at')->get();
        // ->orderBy('created_at', 'DESC')->distinct('from')
        // ->orderBy('created_at', 'desc')->get()->unique('retailer_id');
        $duesTotal = $dues->sum('due');
        return view('backend.pages.stock-out-item.due', ['dues' => $dues, 'duesTotal' => $duesTotal]);
    }

    public function storeRetailerDues(Request $request){
        $due = Payment::whereNull('dealer_id')->whereRetailerId($request->retailer_id)->whereSalesmanId(auth('salesman')->user()->id)->orderBy('created_at', 'desc')->first();
        if (!empty($due)){
            $request = new Request($request->all());
            $request->merge(['due' => $due->due + $request->due, 'salesman_id' => auth('salesman')->user()->id]);
        }
        $request = new Request($request->all());
        $request->merge(['salesman_id' => auth('salesman')->user()->id]);
        Payment::create($request->all());
        return back();
    }

    public function previousRetailerDue($id){
        $due = Payment::whereNull('dealer_id')->whereRetailerId($id)->orderBy('created_at', 'desc')->first();
        return $due;
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
