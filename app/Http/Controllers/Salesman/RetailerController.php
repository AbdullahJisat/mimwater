<?php

namespace App\Http\Controllers\Salesman;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRetailerRequest;
use App\Models\Retailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RetailerController extends Controller
{
    public function __construct(Retailer $retailer)
    {
        $this->retailer = $retailer;
    }

    public function index()
    {
        return view('backend.pages.retailer.index')->with('retailers', $this->retailer->whereSalesmanId(auth('salesman')->user()->id)->get());
    }

    public function create()
    {
        return view('backend.pages.retailer.create');
    }

    public function store(StoreRetailerRequest $request)
    {
        $request = new Request($request->all());
        $request->merge(['password' => Hash::make($request->password)]);
        $this->retailer->create($request->all());
        return redirect()->route('retailers.index');
    }

    public function edit($id)
    {
        $retailer = $this->retailer->findOrFail($id);
        return view('retailer.create', compact('retailer'));
    }

    public function update(Request $request, $id)
    {
        $this->retailer->findOrFail($id)->update($request->validated());
        return redirect()->route('retailers.index');
    }

    public function destroy($id)
    {
        $this->retailer->findOrFail($id)->delete();
        return back();
    }
}



