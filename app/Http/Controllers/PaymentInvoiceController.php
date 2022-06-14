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
        return view('backend.pages.stock-item.invoice', ['item' => $this->stockOutItem->find($id)]);
    }

    public function store(Request $request, $id){
        Payment::create($request->except('_token'));
        return view('backend.pages.stock-item.invoice', ['item' => $this->stockOutItem->find($id)]);
    }

    public function showDues(){
        $dues = Payment::wherePaymentStatus(3)->get();
        return view('backend.pages.stock-out-item.due', ['dues' => $dues]);
    }


}
