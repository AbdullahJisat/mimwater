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

    public function indexStockRetailer()
    {
        return view('backend.pages.stock-item.index-retailer')->with(['stockItems' => $this->stockItem->with('item')->whereStock(1)->whereNull('dealer_id')->get(),'stockOutItems' => $this->stockItem->with('item')->whereStock(0)->get()]);
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
        $preQuantity = $this->stockItem->whereItemId($request->item_id)->whereDealerId($request->dealer_id)->latest()->first();


        if (empty($preDue)) {
            // dd($request->all(), '$predue');
            if (empty($preQuantity)) {
                $request = new Request($request->all());
                $request->merge(["temp_total" => $user->price * $request->quantity, "price" => $user->price * $request->quantity]);
                $saveStock = $this->stockItem->create($request->except('_token'));
                $statement = new Statement();
                $statement->in = $request->quantity;
                $statement->dealer_id = $request->dealer_id;
                $statement->admin_id = auth('admin')->user()->id;
                $statement->stock = $request->quantity;
                $statement->rate = $user->price;
                $statement->bill = $user->price * $request->quantity;
                $statement->due = $statement->bill;
                $statement->save();
                return back();
            } else {
                // dd($request->all(), '$predue!');
                if ($preQuantity->temp_total == 0) {
                    // dd($request->all(), 'temp0');
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
                    $statement = new Statement();
                    $statement->in = $request->quantity;
                    $statement->dealer_id = $request->dealer_id;
                    $statement->admin_id = auth('admin')->user()->id;
                    $statement->stock = $preQuantity->quantity + $request->quantity;
                    $statement->rate = $user->price;
                    $statement->bill = $user->price * $request->quantity;
                    $statement->due = $preQuantity->temp_total + $statement->bill;
                    $statement->save();
                    return back();
                    // }
                } else {
                    // dd($request->all(), '1');
                    // if ($request->stock == 1) {
                    $stockUp = new Request($request->except('_token'));
                    $stockUp->merge(["temp_total" => $preQuantity->temp_total + $user->price * $request->quantity, "price" => $preQuantity->price + $user->price * $request->quantity, 'quantity' => $preQuantity->quantity + $request->quantity]);
                    $updateStock = $this->stockItem->whereDealerId($request->dealer_id)->whereItemId($request->item_id)->latest()->first();
                    $updateStock->update($stockUp->all());
                    $statement = new Statement();
                    $statement->in = $request->quantity;
                    $statement->dealer_id = $request->dealer_id;
                    $statement->admin_id = auth('admin')->user()->id;
                    $statement->stock = $preQuantity->quantity + $request->quantity;
                    $statement->rate = $user->price;
                    $statement->bill = $user->price * $request->quantity;
                    $statement->due = $preQuantity->temp_total + $statement->bill;
                    // dd($stockUp->all(), $updateStock, $statement);
                    $statement->save();
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
            // dd($request->all(), 'empty');
            if (empty($preQuantity)) {
                // dd($request->all(), '$prequantity');
                $request = new Request($request->all());
                $request->merge(["temp_total" => ($user->price * $request->quantity) + $preDue, "price" => $user->price * $request->quantity]);
                $saveStock = $this->stockItem->create($request->except('_token'));
                $statement = new Statement();
                $statement->in = $request->quantity;
                $statement->dealer_id = $request->dealer_id;
                $statement->admin_id = auth('admin')->user()->id;
                $statement->stock = $request->quantity;
                $statement->rate = $user->price;
                $statement->bill = $user->price * $request->quantity;
                $statement->due = $preDue + $statement->bill;
                $statement->save();
                return back();
            } else {
                if ($preQuantity->temp_total == 0) {
                    // dd($request->all(), '$prequan=0');
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
                    $preQuantity->temp_total = $user->price * $request->quantity;
                    $preQuantity->price = $user->price * $request->quantity;
                    $preQuantity->quantity += $request->quantity;
                    $statement = new Statement();
                    $statement->in = $request->quantity;
                    $statement->dealer_id = $request->dealer_id;
                    $statement->admin_id = auth('admin')->user()->id;
                    $statement->stock = $preQuantity->quantity;
                    $statement->rate = $user->price;
                    $statement->bill = $user->price * $request->quantity;
                    $statement->due = $preQuantity->temp_total;
                    $statement->save();
                    $preQuantity->save();
                    return back();
                    // }
                } else {
                    // dd('temp ace', $preQuantity);
                    // if ($request->stock == 1) {
                        $updateStockIn = new Request($request->except('_token'));
                        $updateStockIn->merge(["temp_total" => $preQuantity->temp_total + ($user->price * $request->quantity), "price" => $preQuantity->price + ($user->price * $request->quantity), 'quantity' => $preQuantity->quantity + $request->quantity]);
                        $updateStock = $this->stockItem->whereDealerId($request->dealer_id)->whereItemId($request->item_id)->latest()->first();
                        $statement = new Statement();
                        $statement->in = $request->quantity;
                        $statement->dealer_id = $request->dealer_id;
                        $statement->admin_id = auth('admin')->user()->id;
                        $statement->stock = $preQuantity->quantity + $request->quantity;
                        $statement->rate = $user->price;
                        $statement->bill = $user->price * $request->quantity;
                        $statement->due = $preQuantity->temp_total + $statement->bill;
                        // dd($request->all(), $updateStockIn->all(), $preDue, $preQuantity, $statement);

                        // dd($request->all(), '$pretemp!0', $statement, $preDue);
                        $statement->save();
                    $updateStock->update($updateStockIn->all());
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
        $previousStock = StockItem::whereDealerId($request->dealer_id)->latest()->first();
        $previousStatement = Statement::whereDealerId($request->dealer_id)->latest()->first();
        if (empty($previousStock)) {
            $request = new Request($request->all());
            $request->merge(["temp_total" => 0, "price" => 0]);
            $saveStock = $this->stockItem->create($request->except('_token'));
        } else {
            $previousStock->quantity = $previousStock->quantity + $request->quantity;
            $previousStock->save();
        }
        if (empty($previousStatement)) {
            $statement = new Statement();
            $statement->in = $request->quantity;
            $statement->dealer_id = $request->dealer_id;
            $statement->admin_id = auth('admin')->user()->id;
            $statement->stock = $request->quantity;
            $statement->rate = $user->price;
            $statement->bill = 0;
            $statement->due = 0;
            $statement->save();
        } else {
            $statement = new Statement();
            $statement->in = $request->quantity;
            $statement->dealer_id = $request->dealer_id;
            $statement->admin_id = auth('admin')->user()->id;
            $statement->stock = $previousStatement->stock + $request->quantity;
            $statement->rate = $user->price;
            $statement->bill = 0;
            $statement->due = $previousStatement->due;
            // dd($request->all(), $statement);
            $statement->save();
        }


        return back();

    }

    public function stockInRetailer(Request $request)
    {
        $user = Retailer::find($request->retailer_id);
        $preStock=StockItem::whereItemId($request->item_id)->whereRetailerId($request->retailer_id)->latest()->first();
        if (!empty($preStock)) {
            $request = new Request($request->all());
            $request->merge(["quantity" => $preStock->quantity + $request->quantity, "temp_total" => $preStock->temp_total + ($user->price * $request->quantity), "price" => $preStock->price + ($user->price * $request->quantity)]);
            $saveStock = $preStock->update($request->except('_token'));
        }else {
            $request = new Request($request->all());
            $request->merge(["temp_total" => 0, "price" => 0]);
            $saveStock = $this->stockItem->create($request->except('_token'));
        }

        $statement = new Statement();
        $statement->in = $request->quantity;
        $statement->retailer_id = $request->retailer_id;
        $statement->admin_id = auth('admin')->user()->id;
        $statement->stock = $request->quantity;
        $statement->rate = $user->price;
        $statement->bill = $user->price * $request->quantity;
        $statement->due = 0;
        $statement->save();

        return back();

    }

    public function editDealerStock($id)
    {
        $stockItem = $this->stockItem->findOrFail($id);
        return view('backend.pages.stock-item.edit-stock-dealer', compact('stockItem'));
    }

    public function updateDealerStock(Request $request, $id)
    {
        $this->stockItem->findOrFail($id)->update($request->all());
        return redirect('admin/dealer-stock-items');
    }

    public function destroy($id)
    {
        $this->stockItem->findOrFail($id)->delete();
        return back();
    }
}



