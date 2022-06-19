<?php

namespace App\Http\Controllers\Admin;

use App\Helper\File;
use App\Http\Controllers\Controller;
use App\Models\ProductionFacilities;
use Illuminate\Http\Request;

class ProductionFacilitiesController extends Controller
{
    use File;

    public function __construct(ProductionFacilities $productionFacilities)
    {
        $this->productionFacilities = $productionFacilities;
    }

    public function index()
    {
        return view('backend.pages.production-facilities.index')->with('productionFacilities', $this->productionFacilities->all());
    }

    public function store(Request $request)
    {
        $image_path = [];
        if($request->hasFile('image')) {
            foreach($request->image as $key => $image){
                $image_path[] = ['image' => $this->file($image, 'ProductionFacilities', $key+1)];
            }
        }
        $this->productionFacilities->insert($image_path);
        return redirect()->route('production-facilities.index');
    }

    public function edit($id)
    {
        $productionFacilities = $this->productionFacilities->findOrFail($id);
        return view('production-facilities.create', compact('productionFacilities'));
    }

    public function update(Request $request, $id)
    {
        $this->productionFacilities->findOrFail($id)->update($request->validated());
        return redirect()->route('production-facilities.index');
    }

    public function destroy($id)
    {
        $this->productionFacilities->findOrFail($id)->delete();
        return back();
    }
}
