<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\StockOutItem;
use Illuminate\Http\Request;

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
        $dueCheck = Payment::whereRetailerId($item->retailer_id)->wherePaymentStatus(3)->sum('due');
        return view('backend.pages.stock-item.invoice', compact('item', 'dueCheck'));
    }

    public function store(Request $request, $id){
        $request = new Request($request->all());
        $request->merge(['due' => $request->total - $request->due, 'amount' => $request->due]);
        Payment::create($request->except('_token'));
        return redirect()->route('invoices.dues');
    }

    public function showDues(){
        $dues = Payment::with('retailer')->wherePaymentStatus(3)->whereNull('dealer_id')->get();
        return view('backend.pages.stock-out-item.due', ['dues' => $dues]);
    }

    public function showDealerDues(){
        $dues = Payment::wherePaymentStatus(3)->whereNull('retailer_id')->get();
        return view('backend.pages.stock-out-item.dealer-due', ['dues' => $dues]);
    }

    public function showCashes(){
        $cashes = Payment::whereNull('dealer_id')->get();
        return view('backend.pages.stock-out-item.cash', ['cashes' => $cashes]);
    }

    public function showDealerCashes(){
        $cashes = Payment::whereNull('retailer_id')->get();
        return view('backend.pages.stock-out-item.cash', ['cashes' => $cashes]);
    }
}
