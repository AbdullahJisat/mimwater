<?php

namespace App\Http\Controllers\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Payment;
use App\Models\RequestBottle;
use App\Models\Retailer;
use App\Models\Statement;
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
        return view('backend.pages.stock-item.index')->with(['stockItems' => $this->stockItem->with('item')->whereNull('dealer_id')->whereStock(1)->get(),'stockOutItems' => $this->stockItem->with('item')->whereStock(0)->latest()->get()]);
    }

    public function indexStockDealer()
    {
        return view('backend.pages.stock-item.index-dealer')->with(['stockItems' => $this->stockItem->with('item')->whereStock(1)->whereNull('retailer_id')->get(),'stockOutItems' => $this->stockItem->with('item')->whereStock(0)->get()]);
    }

    public function store(Request $request)
    {
        // dd($request->all()
        // "_token" => "hvGBJBRrjrJTFwMJ4bKwtfmac0QYYpHQcnkJa3ht"
        // "retailer_id" => "1"
        // "item_id" => "1"
        // "quantity" => "12"
        // "stock" => "1");
        // if ($request->has('retailer_id')){
            $user = Retailer::find($request->retailer_id);
            $preQuantity = $this->stockItem->whereRetailerId($request->retailer_id)->whereStock(1)->latest()->first();
            if (empty($preQuantity)){
                $request = new Request($request->all());
                $request->merge(["temp_total" => $user->price * $request->quantity, "price" => $user->price * $request->quantity]);
                $saveStock = $this->stockItem->create($request->except('_token'));
                return back();
            } else {
                if ($preQuantity->temp_total == 0) {
                    // $request = new Request($request->all());
                    // $request->merge(["price" => $preQuantity->price + $user->price * $request->quantity, 'temp_total' => $request->quantity * $user->price, 'quantity' => $preQuantity->quantity + $request->quantity]);
                    // $updateStock = $this->stockItem->whereRetailerId($request->retailer_id)->whereItemId($request->item_id)->latest()->first();
                    // $updateStock->update($request->except(['_token']));
                    // return back();
                    // if ($preQuantity->quantity != 0) {
                    //     $request = new Request($request->all());
                    //     $request->merge(["price" => $preQuantity->price + $user->price * $request->quantity, 'temp_total' => $request->quantity * $user->price, 'quantity' => $preQuantity->quantity + $request->quantity]);
                    //     $updateStock = $this->stockItem->whereRetailerId($request->retailer_id)->whereItemId($request->item_id)->latest()->first();
                    //     $updateStock->update($request->except(['_token']));
                    //     return back();
                    // } else {
                        $request = new Request($request->all());
                        $request->merge(["temp_total" => $user->price * $request->quantity, "price" => $user->price * $request->quantity]);
                        $saveStock = $this->stockItem->create($request->except('_token'));
                        return back();
                    // }
                } else {
                    $request = new Request($request->all());
                    $request->merge(["temp_total" => $preQuantity->temp_total + $user->price * $request->quantity, "price" => $preQuantity->price + $user->price * $request->quantity, 'quantity' => $preQuantity->quantity + $request->quantity]);
                    $saveStock = $preQuantity->update($request->except('_token'));
                    return back();
                    // if ($request->stock == 1) {
                    //     $request = new Request($request->all());
                    //     $request->merge(["price" => $preQuantity->price + $user->price * $request->quantity, 'quantity' => $preQuantity->quantity + $request->quantity]);
                    //     $this->stockItem->whereRetailerId($request->retailer_id)->whereItemId($request->item_id)->latest()->first()->update($request->except(['_token']));
                    //     return back();
                    // } else {
                    //     if ($preQuantity->quantity < $request->quantity) {
                    //         return back()->withErrors(['quantity' => 'Quantity greater than previos quantity'])->onlyInput('quantity');
                    //     } else {
                    //         $this->stockItem->whereRetailerId($request->retailer_id)->whereStock(1)->update(["retailer_id" => $request->retailer_id,
                    //         "item_id" => $request->item_id,
                    //         'quantity' => $preQuantity->quantity - $request->quantity,
                    //         "stock" => 1,
                    //         "price" => $user->price * $request->quantity]);
                    //         $this->stockItem->create(["retailer_id" => $request->retailer_id,
                    //                                     "item_id" => $request->item_id,
                    //                                     "quantity" => $request->quantity,
                    //                                     "stock" => 0,
                    //                                     "price" => $user->price * $request->quantity]);
                    //         return back();
                    //     }
                    // }
                }
            }
        // } else {
        //     $user = Dealer::find($request->dealer_id);
        //     $preQuantity = $this->stockItem->whereDealerId($request->dealer_id)->whereStock(1)->latest()->first();
        //     if (empty($preQuantity)){
        //         $this->stockItem->create($request->all());
        //         return back();
        //     } else {
        //         if ($request->stock === 1) {
        //             $request = new Request($request->all());
        //             $request->merge(['price' => $user->price * $request->quantity, 'quantity' => $preQuantity->quantity + $request->quantity]);
        //             $this->stockItem->whereDealerId($request->dealer_id)->update($request->except(['_token']));
        //             return back();
        //         } else {
        //             if ($preQuantity->quantity < $request->quantity) {
        //                 return back()->withErrors(['quantity' => 'Quantity greater than previos quantity'])->onlyInput('quantity');
        //             } else {
        //                 $request = new Request($request->all());
        //                 $request->merge(['price' => $user->price * $request->quantity, 'quantity' => $preQuantity->quantity - $request->quantity]);
        //                 $this->stockItem->whereDealerId($request->dealer_id)->update($request->except(['_token']));
        //                 return back();
        //             }
        //         }
        //     }
        // }
    }

    public function stockDealer(Request $request)
    {
        $user = Dealer::find($request->dealer_id);
            $preDue = Payment::whereDealerId($request->dealer_id)->latest()->pluck('due')->first();
            $preQuantity = $this->stockItem->whereItemId($request->item_id)->whereDealerId($request->dealer_id)->whereStock(1)->latest()->first();
        $statement = new Statement();
        $statement->in = $request->quantity;
        $statement->dealer_id = $request->dealer_id;
        $statement->admin_id = auth('admin')->user()->id;
        $statement->stock = $request->quantity;
        $statement->rate = $user->price;
        $statement->bill = $user->price * $request->quantity;
        $statement->due = $preDue + $statement->bill;
        $statement->save();

            if (!empty($preDue)){
                if (empty($preQuantity)){
                    $request = new Request($request->all());
                    $request->merge(["temp_total" => $user->price * $request->quantity + $preDue, "price" => $user->price * $request->quantity]);
                    $saveStock = $this->stockItem->create($request->except('_token'));
                    return back();
                } else {
                    if ($preQuantity->temp_total == 0) {
                        // $request = new Request($request->all());
                        // $request->merge(["price" => $preQuantity->price + $user->price * $request->quantity, 'temp_total' => $request->quantity * $user->price, 'quantity' => $preQuantity->quantity + $request->quantity]);
                        // $updateStock = $this->stockItem->whereDealerId($request->dealer_id)->whereItemId($request->item_id)->latest()->first();
                        // $updateStock->update($request->except(['_token']));
                        // $requestBottle = RequestBottle::whereDealerId($request->dealer_id)->latest()->first();
                        // if (!empty($requestBottle)) {
                        //     $requestBottle->delete();
                        //     // $requestBottle->update(['quantity' => $requestBottle->quantity - $updateStock->quantity]);
                        // }
                        // return back();
                        // if ($preQuantity->quantity != 0) {
                        //     $request = new Request($request->all());
                        //     $request->merge(["price" => $preQuantity->price + $user->price * $request->quantity, 'temp_total' => $request->quantity * $user->price, 'quantity' => $preQuantity->quantity + $request->quantity]);
                        //     $updateStock = $this->stockItem->whereDealerId($request->dealer_id)->whereItemId($request->item_id)->latest()->first();
                        //     $updateStock->update($request->except(['_token']));
                        //     $requestBottle = RequestBottle::whereDealerId($request->dealer_id)->latest()->first();
                        //     if (!empty($requestBottle)) {
                        //         $requestBottle->delete();
                        //         // $requestBottle->update(['quantity' => $requestBottle->quantity - $updateStock->quantity]);
                        //     }
                        //     return back();
                        // } else {
                            $request = new Request($request->all());
                            $request->merge(["temp_total" => $user->price * $request->quantity, "price" => $user->price * $request->quantity]);
                            $saveStock = $this->stockItem->create($request->except('_token'));
                            return back();
                        // }
                    } else {
                        // if ($request->stock == 1) {
                            $request = new Request($request->all());
                            $request->merge(["temp_total" => $preQuantity->temp_total + $user->price * $request->quantity, "price" => $preQuantity->price + $user->price * $request->quantity, 'quantity' => $preQuantity->quantity + $request->quantity]);
                            $updateStock = $this->stockItem->whereDealerId($request->dealer_id)->whereItemId($request->item_id)->latest()->first();
                            $updateStock->update($request->except(['_token']));
                            $requestBottle = RequestBottle::whereDealerId($request->dealer_id)->latest()->first();
                            if (!empty($requestBottle)) {
                                $requestBottle->delete();
                                // $requestBottle->update(['quantity' => $requestBottle->quantity - $updateStock->quantity]);
                            }
                            return back();
                        // } else {
                        //     if ($preQuantity->quantity < $request->quantity) {
                        //         return back()->withErrors(['quantity' => 'Quantity greater than previos quantity'])->onlyInput('quantity');
                        //     } else {
                        //         $this->stockItem->whereDealerId($request->dealer_id)->whereStock(1)->update(["dealer_id" => $request->dealer_id,
                        //         "item_id" => $request->item_id,
                        //         'quantity' => $preQuantity->quantity - $request->quantity,
                        //         "stock" => 1,
                        //         "price" => $user->price * $request->quantity]);
                        //         $this->stockItem->create(["dealer_id" => $request->dealer_id,
                        //                                     "item_id" => $request->item_id,
                        //                                     "quantity" => $request->quantity,
                        //                                     "stock" => 0,
                        //                                     "price" => $user->price * $request->quantity]);

                        //         $requestBottle = RequestBottle::whereDealerId($request->dealer_id)->latest()->first();
                        //         if (!empty($requestBottle)) {
                        //             $requestBottle->delete();
                        //             // $requestBottle->update(['quantity' => $requestBottle->quantity - $request->quantity]);
                        //         }
                        //         return back();
                        //     }
                        // }
                    }
                }
            } else {
                if (empty($preQuantity)){
                    $request = new Request($request->all());
                    $request->merge(["temp_total" => $user->price * $request->quantity, "price" => $user->price * $request->quantity]);
                    $saveStock = $this->stockItem->create($request->except('_token'));
                    return back();
                } else {
                    if ($preQuantity->temp_total == 0) {
                        // $request = new Request($request->all());
                        // $request->merge(["price" => $preQuantity->price + $user->price * $request->quantity, 'temp_total' => $request->quantity * $user->price, 'quantity' => $preQuantity->quantity + $request->quantity]);
                        // $updateStock = $this->stockItem->whereDealerId($request->dealer_id)->whereItemId($request->item_id)->latest()->first();
                        // $updateStock->update($request->except(['_token']));
                        // $requestBottle = RequestBottle::whereDealerId($request->dealer_id)->latest()->first();
                        // if (!empty($requestBottle)) {
                        //     $requestBottle->delete();
                        //     // $requestBottle->update(['quantity' => $requestBottle->quantity - $updateStock->quantity]);
                        // }
                        // return back();
                        // if ($preQuantity->quantity != 0) {
                        //     $request = new Request($request->all());
                        //     $request->merge(["price" => $preQuantity->price + $user->price * $request->quantity, 'temp_total' => $request->quantity * $user->price, 'quantity' => $preQuantity->quantity + $request->quantity]);
                        //     $updateStock = $this->stockItem->whereDealerId($request->dealer_id)->whereItemId($request->item_id)->latest()->first();
                        //     $updateStock->update($request->except(['_token']));
                        //     $requestBottle = RequestBottle::whereDealerId($request->dealer_id)->latest()->first();
                        //     if (!empty($requestBottle)) {
                        //         $requestBottle->delete();
                        //         // $requestBottle->update(['quantity' => $requestBottle->quantity - $updateStock->quantity]);
                        //     }
                        //     return back();
                        // } else {
                            $request = new Request($request->all());
                            $request->merge(["temp_total" => $user->price * $request->quantity, "price" => $user->price * $request->quantity]);
                            $saveStock = $this->stockItem->create($request->except('_token'));
                            return back();
                        // }
                    } else {
                        // if ($request->stock == 1) {
                            $request = new Request($request->all());
                            $request->merge(["temp_total" => $preQuantity->temp_total + $user->price * $request->quantity, "price" => $preQuantity->price + $user->price * $request->quantity, 'quantity' => $preQuantity->quantity + $request->quantity]);
                            $updateStock = $this->stockItem->whereDealerId($request->dealer_id)->whereItemId($request->item_id)->latest()->first();
                            $updateStock->update($request->except(['_token']));
                            $requestBottle = RequestBottle::whereDealerId($request->dealer_id)->latest()->first();
                            if (!empty($requestBottle)) {
                                $requestBottle->delete();
                                // $requestBottle->update(['quantity' => $requestBottle->quantity - $updateStock->quantity]);
                            }
                            return back();
                        // } else {
                        //     if ($preQuantity->quantity < $request->quantity) {
                        //         return back()->withErrors(['quantity' => 'Quantity greater than previos quantity'])->onlyInput('quantity');
                        //     } else {
                        //         $this->stockItem->whereDealerId($request->dealer_id)->whereStock(1)->update(["dealer_id" => $request->dealer_id,
                        //         "item_id" => $request->item_id,
                        //         'quantity' => $preQuantity->quantity - $request->quantity,
                        //         "stock" => 1,
                        //         "price" => $user->price * $request->quantity]);
                        //         $this->stockItem->create(["dealer_id" => $request->dealer_id,
                        //                                     "item_id" => $request->item_id,
                        //                                     "quantity" => $request->quantity,
                        //                                     "stock" => 0,
                        //                                     "price" => $user->price * $request->quantity]);

                        //         $requestBottle = RequestBottle::whereDealerId($request->dealer_id)->latest()->first();
                        //         if (!empty($requestBottle)) {
                        //             $requestBottle->delete();
                        //             // $requestBottle->update(['quantity' => $requestBottle->quantity - $request->quantity]);
                        //         }
                        //         return back();
                        //     }
                        // }
                    }
                }
            }

    }

    public function stockInDealer(Request $request)
    {
        $user = Dealer::find($request->dealer_id);
        $request = new Request($request->all());
        $request->merge(["temp_total" => 0, "price" => 0]);
        $saveStock = $this->stockItem->create($request->except('_token'));
        $statement = new Statement();
        $statement->in = $request->quantity;
        $statement->dealer_id = $request->dealer_id;
        $statement->admin_id = auth('admin')->user()->id;
        $statement->stock = $request->quantity;
        $statement->rate = $user->price;
        $statement->bill = $user->price * $request->quantity;
        $statement->due = 0;
        $statement->save();

        return back();

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



