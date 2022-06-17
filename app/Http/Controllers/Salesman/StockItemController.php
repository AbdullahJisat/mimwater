<?php

namespace App\Http\Controllers\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Retailer;
use App\Models\StockItem;
use Illuminate\Http\Request;

class StockItemController extends Controller
{
    public function __construct(StockItem $stockItem)
    {
        $this->stockItem = $stockItem;
        view()->share(['items' => allItem(), 'retailers' => allRetailer(), 'dealers' => allDealer()]);
    }

    public function index()
    {
        // dd(StockItem::findStock());
        return view('backend.pages.stock-item.index')->with(['stockItems' => $this->stockItem->with('item')->whereStock(1)->get(),'stockOutItems' => $this->stockItem->with('item')->whereStock(0)->get()]);
    }

    public function indexStockDealer()
    {
        // dd(StockItem::findStock());
        return view('backend.pages.stock-item.index')->with(['stockItems' => $this->stockItem->with('item')->whereStock(1)->whereNull('retailer_id')->get(),'stockOutItems' => $this->stockItem->with('item')->whereStock(0)->get()]);
    }

    public function store(Request $request)
    {
        // dd($request->all()
        // "_token" => "hvGBJBRrjrJTFwMJ4bKwtfmac0QYYpHQcnkJa3ht"
        // "retailer_id" => "1"
        // "item_id" => "1"
        // "quantity" => "12"
        // "stock" => "1");
        if ($request->has('retailer_id')){
            $user = Retailer::find($request->retailer_id);
            $preQuantity = $this->stockItem->whereRetailerId($request->retailer_id)->whereStock(1)->latest()->first();
            if (empty($preQuantity)){
                $request = new Request($request->all());
                $request->merge(['price' => 0]);
                $this->stockItem->create($request->except('_token'));
                return back();
            } else {
                if ($request->stock == 1) {
                    $request = new Request($request->all());
                    $request->merge(['price' => 0, 'quantity' => $preQuantity->quantity + $request->quantity]);
                    $this->stockItem->whereRetailerId($request->retailer_id)->update($request->except(['_token']));
                    return back();
                } else {
                    if ($preQuantity->quantity < $request->quantity) {
                        return back()->withErrors(['quantity' => 'Quantity greater than previos quantity'])->onlyInput('quantity');
                    } else {
                        $this->stockItem->whereRetailerId($request->retailer_id)->whereStock(1)->update(["retailer_id" => $request->retailer_id,
                        "item_id" => $request->item_id,
                        'quantity' => $preQuantity->quantity - $request->quantity,
                        "stock" => 1,
                        "price" => 0]);
                        $this->stockItem->create(["retailer_id" => $request->retailer_id,
                                                    "item_id" => $request->item_id,
                                                    "quantity" => $request->quantity,
                                                    "stock" => 0,
                                                    "price" => $user->price * $request->quantity]);
                        return back();
                    }
                }
            }
        } else {
            $user = Dealer::find($request->dealer_id);
            $preQuantity = $this->stockItem->whereDealerId($request->dealer_id)->whereStock(1)->latest()->first();
            if (empty($preQuantity)){
                $this->stockItem->create($request->all());
                return back();
            } else {
                if ($request->stock === 1) {
                    $request = new Request($request->all());
                    $request->merge(['price' => $user->price * $request->quantity, 'quantity' => $preQuantity->quantity + $request->quantity]);
                    $this->stockItem->whereDealerId($request->dealer_id)->update($request->except(['_token']));
                    return back();
                } else {
                    if ($preQuantity->quantity < $request->quantity) {
                        return back()->withErrors(['quantity' => 'Quantity greater than previos quantity'])->onlyInput('quantity');
                    } else {
                        $request = new Request($request->all());
                        $request->merge(['price' => $user->price * $request->quantity, 'quantity' => $preQuantity->quantity - $request->quantity]);
                        $this->stockItem->whereDealerId($request->dealer_id)->update($request->except(['_token']));
                        return back();
                    }
                }
            }
        }
    }

    public function stockDealer(Request $request)
    {
            $user = dealer::find($request->dealer_id);
            $preQuantity = $this->stockItem->wheredealerId($request->dealer_id)->whereStock(1)->latest()->first();
            if (empty($preQuantity)){
                $request = new Request($request->all());
                $request->merge(['price' => 0]);
                $this->stockItem->create($request->except('_token'));
                return back();
            } else {
                if ($request->stock == 1) {
                    $request = new Request($request->all());
                    $request->merge(['price' => 0, 'quantity' => $preQuantity->quantity + $request->quantity]);
                    $this->stockItem->wheredealerId($request->dealer_id)->update($request->except(['_token']));
                    return back();
                } else {
                    if ($preQuantity->quantity < $request->quantity) {
                        return back()->withErrors(['quantity' => 'Quantity greater than previos quantity'])->onlyInput('quantity');
                    } else {
                        $this->stockItem->wheredealerId($request->dealer_id)->whereStock(1)->update(["dealer_id" => $request->dealer_id,
                        "item_id" => $request->item_id,
                        'quantity' => $preQuantity->quantity - $request->quantity,
                        "stock" => 1,
                        "price" => 0]);
                        $this->stockItem->create(["dealer_id" => $request->dealer_id,
                                                    "item_id" => $request->item_id,
                                                    "quantity" => $request->quantity,
                                                    "stock" => 0,
                                                    "price" => $user->price * $request->quantity]);
                        return back();
                    }
                }
            }
    }

    public function edit($id)
    {
        $stockItem = $this->stockItem->findOrFail($id);
        return view('stockItem.create', compact('stockItem'));
    }

    public function update(Request $request, $id)
    {
        $this->stockItem->findOrFail($id)->update($request->validated());
        return redirect()->route('stockItems.index');
    }

    public function destroy($id)
    {
        $this->stockItem->findOrFail($id)->delete();
        return back();
    }
}



