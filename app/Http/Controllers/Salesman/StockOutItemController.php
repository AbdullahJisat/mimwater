<?php

namespace App\Http\Controllers\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Retailer;
use App\Models\StockItem;
use App\Models\StockOutItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockOutItemController extends Controller
{
    public function __construct(StockOutItem $stockOutItem, StockItem $stockItem)
    {
        $this->stockOutItem = $stockOutItem;
        $this->stockItem = $stockItem;
        view()->share(['items' => allItem(), 'retailers' => allRetailer(), 'dealers' => allDealer()]);
    }

    public function index()
    {
        return view('backend.pages.stock-out-item.index')->with('stockOutItems', $this->stockOutItem->whereNull('dealer_id')->get());
    }

    public function store(Request $request)
    {
        // DB::beginTransaction();
        try {
            if ($request->has('retailer_id')){
                $user = Retailer::find($request->retailer_id);
                $preQuantity = $this->stockItem->whereRetailerId($request->retailer_id)->whereStock(1)->latest()->first();
                if (empty($preQuantity)){
                    return redirect()->route('stock-items.index')->with('message', "Stock not available");
                } elseif ($preQuantity->quantity == 0) {
                    return redirect()->route('stock-items.index')->with('message', "Stock not available");
                } else {
                    if ($preQuantity->quantity < $request->quantity) {
                        return back()->withErrors(['quantity' => 'Quantity greater than previos quantity'])->onlyInput('quantity');
                    } else {
                        $preQuantity->retailer_id = $request->retailer_id;
                        $preQuantity->item_id = $request->item_id;
                        $preQuantity->quantity = $preQuantity->quantity - $request->quantity;
                        $preQuantity->stock = 1;
                        $preQuantity->price = 0;
                        $preQuantity->save();
                        $saveStockOut = $this->stockOutItem->create(["retailer_id" => $request->retailer_id,
                                                    "item_id" => $request->item_id,
                                                    "quantity" => $request->quantity,
                                                    "price" => $user->price * $request->quantity]);
                        return redirect()->route('invoices.index', $saveStockOut->id);
                    }
                }
            } else {
                $user = Dealer::find($request->dealer_id);
                $preQuantity = $this->stockItem->whereDealerId($request->dealer_id)->whereStock(1)->latest()->first();
                if (empty($preQuantity)){
                    return redirect()->route('stock-items.index')->with('message', "Stock not available");
                } else {
                    if ($preQuantity->quantity < $request->quantity) {
                        return back()->withErrors(['quantity' => 'Quantity greater than previos quantity'])->onlyInput('quantity');
                    } else {
                        $this->stockItem->whereRetailerId($request->retailer_id)->whereStock(1)->update(["retailer_id" => $request->retailer_id,
                        "item_id" => $request->item_id,
                        'quantity' => $preQuantity->quantity - $request->quantity,
                        "stock" => 1,
                        "price" => 0]);
                        $saveStockOut = $this->stockOutItem->create(["retailer_id" => $request->retailer_id,
                                                    "item_id" => $request->item_id,
                                                    "quantity" => $request->quantity,
                                                    "price" => $user->price * $request->quantity]);

                        $item = $this->stockOutItem->find($saveStockOut->id);
                        dd($item);
                        return view('backend.pages.stock-item.invoice', compact('item'));
                    }
                }
            }
            // DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            // DB::rollBack();
        }
    }

    public function indexDealer()
    {
        return view('backend.pages.stock-out-item.dealer-index')->with('stockOutItems', $this->stockOutItem->whereNull('retailer_id')->get());
    }

    public function stockOutDealer(Request $request)
    {
        // DB::beginTransaction();
        try {
                $user = Dealer::find($request->dealer_id);
                $preQuantity = $this->stockItem->whereRetailerId($request->dealer_id)->whereStock(1)->latest()->first();
                if (empty($preQuantity)){
                    return redirect()->route('stock-items.index')->with('message', "Stock not available");
                } elseif ($preQuantity->quantity == 0) {
                    return redirect()->route('stock-items.index')->with('message', "Stock not available");
                } else {
                    if ($preQuantity->quantity < $request->quantity) {
                        return back()->withErrors(['quantity' => 'Quantity greater than previos quantity'])->onlyInput('quantity');
                    } else {
                        $preQuantity->dealer_id = $request->dealer_id;
                        $preQuantity->item_id = $request->item_id;
                        $preQuantity->quantity = $preQuantity->quantity - $request->quantity;
                        $preQuantity->stock = 1;
                        $preQuantity->price = 0;
                        $preQuantity->save();
                        $saveStockOut = $this->stockOutItem->create(["dealer_id" => $request->dealer_id,
                                                    "item_id" => $request->item_id,
                                                    "quantity" => $request->quantity,
                                                    "price" => $user->price * $request->quantity]);
                        return redirect()->route('invoices.index', $saveStockOut->id);
                    }
                }
            // DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            // DB::rollBack();
        }
    }

    public function edit($id)
    {
        $stockOutItem = $this->stockOutItem->findOrFail($id);
        return view('stockOutItem.create', compact('stockOutItem'));
    }

    public function update(Request $request, $id)
    {
        $this->stockOutItem->findOrFail($id)->update($request->validated());
        return redirect()->route('stockOutItems.index');
    }

    public function destroy($id)
    {
        $this->stockOutItem->findOrFail($id)->delete();
        return back();
    }
}



