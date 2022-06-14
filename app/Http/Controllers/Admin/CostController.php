<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Cost;
use Illuminate\Http\Request;

class CostController extends Controller
{
    public function __construct(Cost $cost, Category $category)
    {
        $this->category = $category;
        $this->cost = $cost;
        view()->share('categories', $this->category->all());
    }

    public function index()
    {
        return view('backend.pages.cost.index')->with('costs', $this->cost->all());
    }

    public function store(Request $request)
    {
        $this->cost->create($request->all());
        return redirect()->route('costs.index');
    }

    public function categoryStore(Request $request)
    {
        $this->category->create($request->all());
        return redirect()->route('costs.index');
    }

    public function edit($id)
    {
        $cost = $this->cost->findOrFail($id);
        return view('cost.create', compact('cost'));
    }

    public function update(Request $request, $id)
    {
        $this->cost->findOrFail($id)->update($request->validated());
        return redirect()->route('costs.index');
    }

    public function destroy($id)
    {
        $this->cost->findOrFail($id)->delete();
        return back();
    }
}



