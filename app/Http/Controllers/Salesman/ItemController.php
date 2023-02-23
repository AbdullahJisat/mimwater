<?php

namespace App\Http\Controllers\Salesman;

use App\Helper\File;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    use File;

    public function __construct(Item $item)
    {
        $this->middleware('permission:item-list');
        $this->middleware('permission:item-create', ['only' => ['create','store']]);
        $this->middleware('permission:item-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:item-delete', ['only' => ['destroy']]);
        $this->item = $item;
    }

    public function index()
    {
        return view('backend.pages.item.index')->with('items', $this->item->all());
    }

    public function store(Request $request)
    {
        if($request->hasFile('image')) {
            $image_path = $this->file($request->image, 'item', $request->name);
        }
        $this->item->create(array_merge($request->except('image'), ['image' => $image_path]));
        return back();
    }

    public function edit($id)
    {
        $item = $this->item->findOrFail($id);
        return view('backend.pages.item.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        if($request->hasFile('image')) {
            $image_path = $this->file($request->image, $request->name);
        }
        $item = $this->item->findOrFail($id);
        $item->update(array_merge($request->except('image'), ['image' => $image_path]));
        return redirect()->route('items.index');
    }

    public function destroy($id)
    {
        $item = $this->item->findOrFail($id);
        // unlink('public'.$item->image); // then delete previous photo
        $item->delete();
        return back();
    }
}



