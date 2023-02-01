<?php

namespace App\Http\Controllers;

use App\Models\DailyCashInHand;
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

    public function dailyCashHandStore(Request $request){
        $dailyCashHand = new DailyCashInHand();
        $dailyCashHand->amount = $request->dailyCashAmount;
        $dailyCashHand->admin_id = auth('admin')->user()->id;
        $dailyCashHand->save();
        return back();
    }

    public function index($id)
    {
        $item = $this->stockOutItem->find($id);
        $stockItemTotalPrice = StockItem::whereRetailerId($item->retailer_id)->orWhere('item_id', $item->item_id)->latest()->pluck('temp_total')->first();
        // dd($stockItemTotalPrice);
        $dueCheck = Payment::with('retailer')->whereRetailerId($item->retailer_id)->orWhere('payment_status', 3)->latest()->first();

        $due = StockItem::whereRetailerId($item->retailer_id)->orWhere('item_id', $item->item_id)->latest()->pluck('temp_total')->first();
        return view('backend.pages.stock-item.invoice', compact('item', 'dueCheck', 'stockItemTotalPrice', 'due'));
    }

    public function dealerInvoiceIndex($id)
    {
        $item = $this->stockOutItem->find($id);
        $stockItemTotalPrice = StockItem::whereDealerId($item->dealer_id)->whereItemId($item->item_id)->latest()->pluck('temp_total')->first();
        // dd($stockItemTotalPrice);
        $dueCheck = Payment::whereDealerId($item->dealer_id)->orWhere('payment_status', 3)->latest()->first();

        $due = StockItem::whereDealerId($item->dealer_id)->orWhere('item_id', $item->item_id)->latest()->pluck('temp_total')->first();
        // dd($due);
        return view('backend.pages.stock-item.dealer-invoice', compact('item', 'dueCheck', 'stockItemTotalPrice', 'due'));
    }

    public function dealerInvoiceStockOutIndex($id)
    {
        $item = $this->stockOutItem->find($id);

        // dd($stockItemTotalPrice);
        $dueCheck = Payment::whereDealerId($item->dealer_id)->orWhere('payment_status', 3)->latest()->first();

        $due = $item->price;
        // dd($due);
        return view('backend.pages.stock-item.dealer-invoice-stock-out', compact('item', 'dueCheck', 'due'));
    }

    public function dealerInvoiceStore(Request $request, $id)
    {
        dd($request->all(), 'IN');
        $previousDue = Payment::whereDealerId($request->dealer_id)->latest()->first();
        DB::transaction(function () use ($request, $id, $previousDue) {
            if ($request->discount !== 0 || $request->discount != "") {
                $discount = $request->discount;
            } else {
                $discount = 0;
            }

            if (empty($previousDue)) {
                if ($request->action == 'pay') {
                    $item = $this->stockOutItem->find($id);
                    $user = Dealer::find($request->dealer_id);
                    // dd($request->all());
                    // Payment::whereDealerId($request->dealer_id)->whereAdminId(auth('admin')->user()->id)->update(['due' => 0]);
                    $request = new Request($request->all());




                    if ($request->totalDue == 0) {
                        $request->merge(['admin_id' => auth('admin')->user()->id, 'due' => ($request->total - $request->due) - $discount, 'amount' => $request->due, 'total' => $request->total, 'discount' => $discount]);
                    } else {
                        $request->merge(['admin_id' => auth('admin')->user()->id, 'due' => ($request->totalDue - $request->due) - $discount, 'amount' => $request->due, 'total' => $request->total, 'discount' => $discount]);
                    }

                    Payment::create($request->except('_token', 'totalDue', 'action', 'discount'));

                    // $preDue = Payment::whereDealerId($request->dealer_id)->latest()->pluck('due')->first();
                    $preQuantity = Statement::whereDealerId($request->dealer_id)->latest()->first();
                    // dd($preQuantity->due);
                    $statement = new Statement();
                    $statement->out = $item->quantity;
                    $statement->dealer_id = $request->dealer_id;
                    $statement->admin_id = auth('admin')->user()->id;
                    $statement->stock = abs($item->quantity - $preQuantity->stock);
                    $statement->rate = $user->price;
                    if ($request->amount != '') {
                        $statement->bill = 0;
                        $statement->payment = $request->amount;
                        $statement->due = abs(($preQuantity->due - $request->amount) - $discount);
                        $statement->discount = $discount;
                        // dd('not null', $request->all(), $item, $statement, $preQuantity);
                    } else {
                        $statement->bill = 0;
                        $statement->due = $request->amount + $preQuantity->due;
                        $statement->discount = $discount;
                        // dd($request->all(), $item, $statement, $preQuantity);
                    }
                    $statement->save();

                    // $previousDue = Payment::whereDealerId($request->dealer_id)->latest()->first();
                    // dd($statement, $item, $preQuantity, $request->all(), $previousDue);
                    $stockItem = StockItem::whereDealerId($request->dealer_id)->whereItemId($item->item_id)->latest()->first();
                    // dd($request->all(), $stockItem, $request->due, $item->item_id);
                    // $temp_total = abs($stockItem->price - $request->due);
                    $stockItem->temp_total = abs(($stockItem->temp_total - $request->amount) - $discount);
                    // dd($stockItem, $request->all());
                    $stockItem->save();
                } else {
                    $item = $this->stockOutItem->find($id);
                    if (isset($item)) {
                        $stockUpdate = StockItem::whereItemId($item->item_id)->whereDealerId($request->dealer_id)->latest()->first();
                        if (isset($stockUpdate)) {
                            $stockUpdate->quantity += $item->quantity;
                            $stockUpdate->temp_total += $item->price;
                            $stockUpdate->save();
                            $item->delete();
                        }
                    }
                }
            } else {
                if ($request->action == 'pay') {
                    $item = $this->stockOutItem->find($id);
                    $user = Dealer::find($request->dealer_id);
                    // dd($request->all());
                    // Payment::whereDealerId($request->dealer_id)->whereAdminId(auth('admin')->user()->id)->update(['due' => 0]);
                    $request = new Request($request->all());


                    if ($request->totalDue == 0) {
                        $request->merge(['admin_id' => auth('admin')->user()->id, 'due' => ($request->total - $request->due) - $discount, 'amount' => $request->due, 'total' => $request->total]);
                    } else {
                        $request->merge(['admin_id' => auth('admin')->user()->id, 'due' => ($request->totalDue - $request->due) - $discount, 'amount' => $request->due, 'total' => $request->total]);
                    }

                    // $preDue = Payment::whereDealerId($request->dealer_id)->latest()->pluck('due')->first();
                    // dd($request->all());

                    $previousDue->update($request->except('_token', 'totalDue', 'action', 'discount'));

                    $preQuantity = Statement::whereDealerId($request->dealer_id)->latest()->first();
                    // dd($preQuantity->due);
                    $statement = new Statement();
                    $statement->out = $item->quantity;
                    $statement->dealer_id = $request->dealer_id;
                    $statement->admin_id = auth('admin')->user()->id;
                    $statement->stock = abs($item->quantity - $preQuantity->stock);
                    $statement->rate = $user->price;
                    if ($request->amount != '') {
                        $statement->bill = 0;
                        $statement->payment = $request->amount;
                        $statement->due = abs(($preQuantity->due - $request->amount) - $discount);
                        $statement->discount = $discount;
                        // dd('not null', $request->all(), $item, $statement, $preQuantity);
                    } else {
                        $statement->bill = 0;
                        $statement->due = $request->amount + $preQuantity->due;
                        $statement->discount = $discount;
                        // dd($request->all(), $item, $statement, $preQuantity);
                    }
                    $statement->save();

                    // $previousDue = Payment::whereDealerId($request->dealer_id)->latest()->first();
                    // dd($statement, $item, $preQuantity, $request->all(), $previousDue);

                    $stockItem = StockItem::whereDealerId($request->dealer_id)->whereItemId($item->item_id)->latest()->first();
                    // $temp_total = abs($stockItem->price - $request->due);
                    // dd($request->all(), $stockItem->price, $request->due, $temp_total);
                    // dd($stockItem, $request->all());
                    if (!empty($stockItem)) {
                        $stockItem->temp_total = abs(($stockItem->temp_total - $request->amount) - $discount);
                        $stockItem->save();
                    }
                } else {
                    $item = $this->stockOutItem->find($id);
                    if (isset($item)) {
                        $stockUpdate = StockItem::whereItemId($item->item_id)->whereDealerId($request->dealer_id)->latest()->first();
                        if (isset($stockUpdate)) {
                            $stockUpdate->quantity += $item->quantity;
                            $stockUpdate->temp_total += $item->price;
                            $stockUpdate->save();
                            $item->delete();
                        }
                    }
                }
            }
        });
        // catch (\Throwable $e) {
        //     DB::rollback();
        //     throw $e;
        // }
        return redirect()->route('invoices.dealer_cashes');
    }

    public function dealerInvoiceStockOutStore(Request $request, $id)
    {
        $request->validate([
            'payment_type' => 'required|integer',
        ]);
        // dd($request->all());
        $previousDue = Payment::whereDealerId($request->dealer_id)->latest()->first();
        DB::transaction(function () use ($request, $id, $previousDue) {
            if ($request->discount !== 0 || $request->discount != "") {
                $discount = $request->discount;
            } else {
                $discount = 0;
            }

            if (empty($previousDue)) {
                if ($request->action == 'pay') {
                    $item = $this->stockOutItem->find($id);
                    $user = Dealer::find($request->dealer_id);
                    // dd($request->all());
                    // Payment::whereDealerId($request->dealer_id)->whereAdminId(auth('admin')->user()->id)->update(['due' => 0]);
                    $request = new Request($request->all());




                    if ($request->totalDue == 0) {
                        $request->merge(['admin_id' => auth('admin')->user()->id, 'due' => ($request->total - $request->due) - $discount, 'amount' => $request->due, 'total' => $request->total, 'discount' => $discount]);
                    } else {
                        $request->merge(['admin_id' => auth('admin')->user()->id, 'due' => ($request->totalDue - $request->due) - $discount, 'amount' => $request->due, 'total' => $request->total, 'discount' => $discount]);
                    }

                    Payment::create($request->except('_token', 'totalDue', 'action', 'discount'));
                    // $preDue = Payment::whereDealerId($request->dealer_id)->latest()->pluck('due')->first();
                    $preQuantity = Statement::whereDealerId($request->dealer_id)->latest()->first();
                    // dd($preQuantity->due);
                    $statement = new Statement();
                    $statement->out = $item->quantity;
                    $statement->dealer_id = $request->dealer_id;
                    $statement->admin_id = auth('admin')->user()->id;
                    $statement->stock = abs($item->quantity - $preQuantity->stock);
                    $statement->rate = $user->price;
                    if ($request->amount != '' && $request->amount != 0) {
                        $statement->bill = 0;
                        $statement->payment = $request->amount;
                        $statement->due = abs(($item->price - $request->amount) - $discount);
                        $statement->discount = $discount;
                        // dd('not null', $request->all(), $item, $statement, $preQuantity);
                    } else {
                        $statement->bill = 0;
                        $statement->due = $request->amount + $item->price;
                        $statement->discount = $discount;
                        // dd($request->all(), $item, $statement, $preQuantity);
                    }
                    $statement->save();

                    // $previousDue = Payment::whereDealerId($request->dealer_id)->latest()->first();
                    // dd($statement, $item, $preQuantity, $request->all(), $previousDue);
                    // if (empty($peviousDue)){

                    // } else {
                    //     // $prviousDue->due = $previousDue + )
                    // }
                    // $stockItem = StockItem::whereDealerId($request->dealer_id)->whereItemId($item->item_id)->latest()->first();
                    // // dd($request->all(), $stockItem, $request->due, $item->item_id);
                    // // $temp_total = abs($stockItem->price - $request->due);
                    // $stockItem->temp_total = abs(($stockItem->temp_total - $request->amount) - $discount);
                    // // dd($stockItem, $request->all());
                    // $stockItem->save();
                } else {
                    $item = $this->stockOutItem->find($id);
                    if (isset($item)) {
                        $stockUpdate = StockItem::whereItemId($item->item_id)->whereDealerId($request->dealer_id)->latest()->first();
                        if (isset($stockUpdate)) {
                            $stockUpdate->quantity += $item->quantity;
                            $stockUpdate->temp_total += $item->price;
                            $stockUpdate->save();
                            $item->delete();
                        }
                    }
                }
            } else {
                if ($request->action == 'pay') {
                    $item = $this->stockOutItem->find($id);
                    $user = Dealer::find($request->dealer_id);
                    // dd($request->all());
                    // Payment::whereDealerId($request->dealer_id)->whereAdminId(auth('admin')->user()->id)->update(['due' => 0]);
                    $request = new Request($request->all());


                    if ($request->totalDue == 0) {
                        $request->merge(['admin_id' => auth('admin')->user()->id, 'due' => ($request->total - $request->due) - $discount, 'amount' => $request->due, 'total' => $request->total]);
                    } else {
                        $request->merge(['admin_id' => auth('admin')->user()->id, 'due' => ($request->totalDue - $request->due) - $discount, 'amount' => $request->due, 'total' => $request->total]);
                    }

                    // $preDue = Payment::whereDealerId($request->dealer_id)->latest()->pluck('due')->first();
                    // dd($request->all());


                        // $previousDue->update($request->except('_token', 'totalDue', 'action', 'discount'));
                        Payment::create($request->except('_token', 'totalDue', 'action', 'discount'));


                    $preQuantity = Statement::whereDealerId($request->dealer_id)->latest()->first();
                    // dd($preQuantity->due);
                    $statement = new Statement();
                    $statement->out = $item->quantity;
                    $statement->dealer_id = $request->dealer_id;
                    $statement->admin_id = auth('admin')->user()->id;
                    $statement->stock = abs($item->quantity - $preQuantity->stock);
                    $statement->rate = $user->price;
                    if ($request->amount != '') {
                        $statement->bill = $item->quantity + $user->price;
                        $statement->payment = $request->amount;
                        $statement->due = abs(($item->price - $request->amount) - $discount);
                        $statement->discount = $discount;
                        // dd('not null','not empty due', $request->all(), $item, $statement, $preQuantity);
                    } else {
                        $statement->bill = $item->quantity + $user->price;
                        $statement->due = $request->amount + $item->quantity * $user->price + $preQuantity->due;
                        $statement->discount = $discount;
                        // dd($request->all(), 'not empty due', $item, $statement, $preQuantity);
                    }
                    $statement->save();

                    // $previousDue = Payment::whereDealerId($request->dealer_id)->latest()->first();
                    // dd($statement, $item, $preQuantity, $request->all(), $previousDue);

                    // $stockItem = StockItem::whereDealerId($request->dealer_id)->whereItemId($item->item_id)->latest()->first();
                    // // $temp_total = abs($stockItem->price - $request->due);
                    // // dd($request->all(), $stockItem->price, $request->due, $temp_total);
                    // // dd($stockItem, $request->all());
                    // if (!empty($stockItem)) {
                    //     $stockItem->temp_total = abs(($stockItem->temp_total - $request->amount) - $discount);
                    //     $stockItem->save();
                    // }
                } else {
                    $item = $this->stockOutItem->find($id);
                    if (isset($item)) {
                        $stockUpdate = StockItem::whereItemId($item->item_id)->whereDealerId($request->dealer_id)->latest()->first();
                        if (isset($stockUpdate)) {
                            $stockUpdate->quantity += $item->quantity;
                            $stockUpdate->temp_total += $item->price;
                            $stockUpdate->save();
                            $item->delete();
                        }
                    }
                }
            }
        });
        // catch (\Throwable $e) {
        //     DB::rollback();
        //     throw $e;
        // }
        return redirect()->route('invoices.dealer_cashes');
    }


    public function store(Request $request, $id)
    {
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

    public function showDues()
    {
        $dues = Payment::with('retailer', 'salesman')->wherePaymentStatus(3)->whereNull('dealer_id')->whereDate('created_at', Carbon::today())->get();
        $duesTotal = $dues->sum('due');
        return view('backend.pages.stock-out-item.due', ['dues' => $dues, 'duesTotal' => $duesTotal]);
    }

    public function showDealerDuesReport()
    {
        $dues = Payment::with('dealer', 'admin')->whereNull('retailer_id')->dealer()->today()->get();
        $duesTotal = $dues->sum('due');
        return view('backend.pages.stock-out-item.dealer-due-report', ['dues' => $dues, 'duesTotal' => $duesTotal]);
    }

    public function showDealerDuesReportDateFilter(Request $request)
    {
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $dues = Payment::with('dealer', 'admin')->whereNull('retailer_id')->whereDealerId(auth('dealer')->user()->id)->whereBetween('created_at', [$start, $end])->get();
            $duesTotal = $dues->sum('due');
            return view('backend.pages.stock-out-item.dealer-due-report', ['start' => $start, 'end' => $end, 'dues' => $dues, 'duesTotal' => $duesTotal]);
        } else {
            return back()->with('date older');
        }
    }

    public function showDealerCashesReport()
    {
        $cashes = Payment::with('dealer', 'admin')->whereNull('retailer_id')->whereDealerId(auth('dealer')->user()->id)->whereDate('created_at', Carbon::today())->get();
        $cashesTotal = $cashes->sum('total');
        $duesTotal = $cashes->sum('due');
        $amountTotal = $cashes->sum('amount');
        return view('backend.pages.stock-out-item.dealer-cash-report', ['cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
    }

    public function showDealerCashesReportDateFilter(Request $request)
    {
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $cashes = Payment::with('dealer', 'admin')->whereNull('retailer_id')->whereDealerId(auth('dealer')->user()->id)->whereBetween('created_at', [$start, $end])->get();
            $cashesTotal = $cashes->sum('total');
            $duesTotal = $cashes->sum('due');
            $amountTotal = $cashes->sum('amount');
            return view('backend.pages.stock-out-item.dealer-cash-report', ['start' => $start, 'end' => $end, 'cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
        } else {
            return back()->with('date older');
        }
    }

    public function showRetailerDuesReport()
    {
        $dues = Payment::with('retailer', 'salesman')->whereNull('dealer_id')->whereRetailerId(auth('retailer')->user()->id)->where('due', '!=', 0)->whereDate('created_at', Carbon::today())->get();
        $duesTotal = $dues->sum('due');
        return view('backend.pages.stock-out-item.retailer-due-report', ['dues' => $dues, 'duesTotal' => $duesTotal]);
    }

    public function showRetailerDuesReportDateFilter(Request $request)
    {
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $dues = Payment::with('retailer', 'salesman')->whereNull('dealer_id')->whereRetailerId(auth('retailer')->user()->id)->where('due', '!=', 0)->whereBetween('created_at', [$start, $end])->get();
            $duesTotal = $dues->sum('due');
            return view('backend.pages.stock-out-item.retailer-due-report', ['start' => $start, 'end' => $end, 'dues' => $dues, 'duesTotal' => $duesTotal]);
        } else {
            return back()->with('date older');
        }
    }

    public function showRetailerCashesReport()
    {
        $cashes = Payment::with('retailer', 'salesman')->whereNull('dealer_id')->whereRetailerId(auth('retailer')->user()->id)->whereDate('created_at', Carbon::today())->get();
        $cashesTotal = $cashes->sum('total');
        $duesTotal = $cashes->sum('due');
        $amountTotal = $cashes->sum('amount');
        return view('backend.pages.stock-out-item.retailer-cash-report', ['cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
    }

    public function showRetailerCashesReportDateFilter(Request $request)
    {
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $cashes = Payment::with('retailer', 'salesman')->whereNull('dealer_id')->whereRetailerId(auth('retailer')->user()->id)->whereBetween('created_at', [$start, $end])->get();
            $cashesTotal = $cashes->sum('total');
            $duesTotal = $cashes->sum('due');
            $amountTotal = $cashes->sum('amount');
            return view('backend.pages.stock-out-item.retailer-cash-report', ['start' => $start, 'end' => $end, 'cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
        } else {
            return back()->with('date older');
        }
    }

    public function showDealerDues()
    {
        $dues = Payment::whereNull('retailer_id')->whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->get()->unique('dealer_id');;
        $duesTotal = $dues->sum('due');
        return view('backend.pages.stock-out-item.dealer-due', ['dues' => $dues, 'duesTotal' => $duesTotal, 'dealers' => allDealer()]);
    }

    public function storeDealerDues(Request $request)
    {
        $due = Payment::whereNull('retailer_id')->whereDealerId($request->dealer_id)->orderBy('created_at', 'desc')->first();
        $preStock = StockOutItem::whereNull('retailer_id')->whereDealerId($request->dealer_id)->orderBy('created_at', 'desc')->first();
        DB::transaction(function () use ($request, $due, $preStock) {
            if (!empty($due)) {
                // dd($due, $preStock, $request->all(), 'due');
                $dueInsert = new Request($request->except('temp_total'));
                $dueInsert->merge(['dealer_id' => $request->dealer_id, 'due' => $due->due + $request->due, 'admin_id' => auth('admin')->user()->id, 'temp_total' => $request->due]);
                // dd($preStock, $due, $dueInsert->all(), 'not due');
                $due->update($dueInsert->all());
            } elseif (!empty($preStock)) {
                $duesInsert = new Request($request->except('temp_total'));
                $duesInsert->merge(['dealer_id' => $request->dealer_id, 'admin_id' => auth('admin')->user()->id, 'due' => $preStock->price + $request->due]);
                // dd($preStock, $due, $duesInsert->all(), 'not stock');
                // dd($due, $preStock, $request->all());
                Payment::create($duesInsert->all());
            } else {
                $ndueInsert = new Request($request->except('temp_total'));
                $ndueInsert->merge(['dealer_id' => $request->dealer_id, 'admin_id' => auth('admin')->user()->id]);
                // dd($preStock, $due, $ndueInsert->all());
                // dd($due, $preStock, $request->all());
                Payment::create($ndueInsert->all());
            }

            // if (!empty($preStock)) {
            //     if ($preStock->temp_total != 0) {
            //         $stock = new Request($request->except('due', 'admin_id'));
            //         $stock->merge(['dealer_id' => $request->dealer_id, 'temp_total' => $preStock->temp_total + $request->due]);
            //         $preStock->update($stock->all());
            //     } else {
            //         $stock = new Request($request->except('due', 'admin_id'));
            //         $stock->merge(['temp_total' => $request->due, 'dealer_id' => $request->dealer_id]);
            //         // dd($due, $preStock, $stock->all());
            //         StockItem::create($stock->all());
            //     }

            //     // dd($due, $preStock, $request->all(), 'stock');
            // } else {
            //     $stock = new Request($request->except('due', 'admin_id'));
            //     $stock->merge(['temp_total' => $request->due, 'dealer_id' => $request->dealer_id]);
            //     // dd($due, $preStock, $stock->all());
            //     StockItem::create($stock->all());
            // }
            $previousStatement = Statement::whereDealerId($request->dealer_id)->latest()->first();
            if (empty($previousStatement)) {
                $statement = new Statement();
                $statement->in = 0;
                $statement->dealer_id = $request->dealer_id;
                $statement->admin_id = auth('admin')->user()->id;
                $statement->stock = 0;
                $statement->due = $request->due;
                $statement->save();
            } else {
                $statement = new Statement();
                $statement->in = $previousStatement->in;
                $statement->stock = $previousStatement->stock;
                $statement->dealer_id = $request->dealer_id;
                $statement->admin_id = auth('admin')->user()->id;
                $statement->due = $request->due + $previousStatement->due;
                // dd($request->all(), $statement);
                $statement->save();
            }
        });
        return back();
    }

    public function previousDealerDue($id)
    {
        $due = Payment::whereNull('retailer_id')->whereDealerId($id)->orderBy('created_at', 'desc')->first();
        return $due;
    }

    public function showDealerDuesDateFilter(Request $request)
    {
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $dues = Payment::whereNull('retailer_id')->whereBetween('created_at', [$start, $end])->get();
            $duesTotal = $dues->sum('due');
            return view('backend.pages.stock-out-item.dealer-due', ['start' => $start, 'end' => $end, 'dues' => $dues, 'duesTotal' => $duesTotal]);
        } else {
            return back()->with('date older');
        }
    }

    public function showDuesDateFilter(Request $request)
    {

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
        } else {
            return back()->with('date older');
        }
    }

    public function showCashes()
    {
        $cashes = Payment::with('retailer', 'salesman')->whereNull('dealer_id')->whereDate('created_at', Carbon::today())->get();
        $cashesTotal = $cashes->sum('total');
        $duesTotal = $cashes->sum('due');
        $amountTotal = $cashes->sum('amount');
        return view('backend.pages.stock-out-item.cash', ['cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
    }

    public function showCashesDateFilter(Request $request)
    {
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
        } else {
            return back()->with('date older');
        }
    }

    public function showDealerCashes()
    {
        $cashes = Payment::whereNull('retailer_id')->whereDate('created_at', Carbon::today())->get();
        $cashesTotal = $cashes->sum('total');
        $duesTotal = Payment::whereNull('retailer_id')->sum('due');
        $amountTotal = $cashes->sum('amount');
        return view('backend.pages.stock-out-item.dealer-cash', ['cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
    }

    public function showDealerCashesDateFilter(Request $request)
    {
        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $cashes = Payment::with('retailer', 'salesman')->whereNull('retailer_id')->whereBetween('created_at', [$start, $end])->get();
            $cashesTotal = $cashes->sum('total');
            $duesTotal = $cashes->sum('due');
            $amountTotal = $cashes->sum('amount');
            return view('backend.pages.stock-out-item.dealer-cash', ['start' => $start, 'end' => $end, 'cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
        } else {
            return back()->with('date older');
        }
    }

    public function showRetailerCashes()
    {
        $cashes = Payment::whereNull('dealer_id')->whereSalesmanId(auth('salesman')->user()->id)->whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->get()->unique('retailer_id');
        $cashesTotal = $cashes->sum('total');
        $duesTotal = $cashes->sum('due');
        $amountTotal = $cashes->sum('amount');
        return view('backend.pages.stock-out-item.cash', ['cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
    }

    public function showRetailerCashesDateFilter(Request $request)
    {

        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $cashes = Payment::whereNull('dealer_id')->whereSalesmanId(auth('salesman')->user()->id)->whereBetween('created_at', [$start, $end])->get();
            $cashesTotal = $cashes->sum('total');
            $duesTotal = $cashes->sum('due');
            $amountTotal = $cashes->sum('amount');
            return view('backend.pages.stock-out-item.cash', ['start' => $start, 'end' => $end, 'cashes' => $cashes, 'cashesTotal' => $cashesTotal, 'duesTotal' => $duesTotal, 'amountTotal' => $amountTotal]);
        } else {
            return back()->with('date older');
        }
    }

    public function showRetailerDues()
    {
        $dues = Payment::with('retailer')->whereNull('dealer_id')->whereSalesmanId(auth('salesman')->user()->id)->whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->get()->unique('retailer_id');
        // ->groupBy('retailer_id')->latest('created_at')->get();
        // ->orderBy('created_at', 'DESC')->distinct('from')
        // ->orderBy('created_at', 'desc')->get()->unique('retailer_id');
        $duesTotal = $dues->sum('due');
        return view('backend.pages.stock-out-item.due', ['dues' => $dues, 'duesTotal' => $duesTotal]);
    }

    public function storeRetailerDues(Request $request)
    {
        $due = Payment::whereNull('dealer_id')->whereRetailerId($request->retailer_id)->whereSalesmanId(auth('salesman')->user()->id)->orderBy('created_at', 'desc')->first();
        if (!empty($due)) {
            $request = new Request($request->all());
            $request->merge(['due' => $due->due + $request->due, 'salesman_id' => auth('salesman')->user()->id]);
        }
        $request = new Request($request->all());
        $request->merge(['salesman_id' => auth('salesman')->user()->id]);
        Payment::create($request->all());
        return back();
    }

    public function previousRetailerDue($id)
    {
        $due = Payment::whereNull('dealer_id')->whereRetailerId($id)->orderBy('created_at', 'desc')->first();
        return $due;
    }

    public function showRetailerDuesDateFilter(Request $request)
    {

        $start = Carbon::createFromFormat('Y-m-d', $request->start)->startOfDay();
        $end = Carbon::createFromFormat('Y-m-d', $request->end)->endOfDay();

        if ($end >= $start) {
            $dues = Payment::with('retailer')->whereNull('dealer_id')->whereSalesmanId(auth('salesman')->user()->id)->where('due', '!=', 0)->whereBetween('created_at', [$start, $end])->get();
            $duesTotal = $dues->sum('due');
            return view('backend.pages.stock-out-item.due', ['start' => $start, 'end' => $end, 'dues' => $dues, 'duesTotal' => $duesTotal]);
        } else {
            return back()->with('date older');
        }
    }
}
