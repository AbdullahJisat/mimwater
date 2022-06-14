<?php

namespace App\Http\Controllers\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\RequestBottle;
use Illuminate\Http\Request;

class RequestBottleController extends Controller
{
    public function __construct(RequestBottle $requestBottle, Item $item)
    {
        $this->requestBottle = $requestBottle;
        $this->items = $item->all();
        view()->share('items', $this->items);
    }

    public function index()
    {
        return view('backend.pages.request-bottle.index')->with('requestBottles', $this->requestBottle->with('item')->get());
    }

    public function store(Request $request)
    {
        $request = new Request($request->all());
        $request->merge(['retailer_id' => 1]);
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



