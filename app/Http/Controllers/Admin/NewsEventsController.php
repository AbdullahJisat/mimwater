<?php

namespace App\Http\Controllers\Admin;

use App\Helper\File;
use App\Http\Controllers\Controller;
use App\Models\NewsEvents;
use Illuminate\Http\Request;

class NewsEventsController extends Controller
{
    use File;

    public function __construct(NewsEvents $newsEvents)
    {
        $this->newsEvents = $newsEvents;
    }

    public function index()
    {
        return view('backend.pages.news-events.index')->with('newsEvents', $this->newsEvents->all());
    }

    public function store(Request $request)
    {
        $image_path = [];
        if($request->hasFile('image')) {
            foreach($request->image as $key => $image){
                $image_path[] = ['image' => $this->file($image, 'newsEvents', $key+1)];
            }
        }
        $this->newsEvents->insert($image_path);
        return redirect()->route('news-events.index');
    }

    public function edit($id)
    {
        $newsEvents = $this->newsEvents->findOrFail($id);
        return view('news-events.create', compact('newsEvents'));
    }

    public function update(Request $request, $id)
    {
        $this->newsEvents->findOrFail($id)->update($request->validated());
        return redirect()->route('news-events.index');
    }

    public function destroy($id)
    {
        $this->newsEvents->findOrFail($id)->delete();
        return back();
    }
}
