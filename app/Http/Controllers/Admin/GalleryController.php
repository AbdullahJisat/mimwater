<?php

namespace App\Http\Controllers\Admin;

use App\Helper\File;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    use File;

    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    public function index()
    {
        return view('backend.pages.gallery.index')->with('galleries', $this->gallery->all());
    }

    public function store(Request $request)
    {
        $image_path = [];
        if($request->hasFile('image')) {
            foreach($request->image as $key => $image){
                $image_path[] = ['image' => $this->file($image, 'gallery', $key+1)];
            }
        }
        $this->gallery->insert($image_path);
        return redirect()->route('galleries.index');
    }

    public function edit($id)
    {
        $gallery = $this->gallery->findOrFail($id);
        return view('gallery.create', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $this->gallery->findOrFail($id)->update($request->validated());
        return redirect()->route('gallerys.index');
    }

    public function destroy($id)
    {
        $this->gallery->findOrFail($id)->delete();
        return back();
    }
}



