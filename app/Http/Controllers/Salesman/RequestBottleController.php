<?php

namespace App\Http\Controllers\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\RequestBottle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestBottleController extends Controller
{
    public function __construct(RequestBottle $requestBottle, Item $item)
    {
        $this->requestBottle = $requestBottle;
        $this->items = $item->all();
        view()->share('items', $this->items);
    }


    public function dealerRequest()
    {
        $requestBottles = $this->requestBottle->with('item', 'dealer')->get();
        return view('backend.pages.request-bottle.dealer-request', compact('requestBottles'));
    }

    public function index()
    {
        if (Auth::guard('dealer')->check()) {
            $requestBottles = $this->requestBottle->with('item')->whereDealerId(auth('dealer')->user()->id)->get();
        } else {
            $requestBottles = $this->requestBottle->with('item')->whereRetailerId(auth('retailer')->user()->id)->get();
        }

        return view('backend.pages.request-bottle.index', compact('requestBottles'));
    }

    public function store(Request $request)
    {
        $request = new Request($request->all());
        if (Auth::guard('dealer')->check()) {
            $request->merge(['dealer_id' => auth('dealer')->user()->id]);
        } else {
            $request->merge(['retailer_id' => auth('retailer')->user()->id]);
        }
        $this->requestBottle->create($request->all());
        return back();
    }

    public function edit($id)
    {
        $requestBottle = $this->requestBottle->findOrFail($id);
        return view('backend.pages.request-bottle.create', compact('requestBottle'));
    }

    public function update(Request $request, $id)
    {
        $this->requestBottle->findOrFail($id)->update($request->validated());
        return redirect()->route('request-bottles.index');
    }

    public function destroy($id)
    {
        $this->requestBottle->findOrFail($id)->delete();
        return back();
    }
}



