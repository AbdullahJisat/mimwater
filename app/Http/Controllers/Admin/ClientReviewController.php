<?php

namespace App\Http\Controllers\Admin;

use App\Helper\File;
use App\Http\Controllers\Controller;
use App\Models\ClientReview;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;

class ClientReviewController extends Controller
{
    use File;

    public function __construct(ClientReview $clientReview, Department $department, Designation $designation)
    {
        $this->clientReview = $clientReview;
        $this->department = $department;
        $this->designation = $designation;
        view()->share(['departments' => $this->department->all(), 'designations' => $this->designation->all()]);
    }

    public function index()
    {
        return view('backend.pages.client-review.index')->with('clientReviews', $this->clientReview->all());
    }

    public function create()
    {
        return view('backend.pages.client-review.create');
    }

    public function store(Request $request)
    {
        if($request->hasFile('image')) {
            $image_path = $this->file($request->image, 'client', $request->client_name);
        }
        $request = new Request($request->all());
        $request->merge(['image' => $image_path]);
        $this->clientReview->create($request->all());
        return redirect()->route('client-reviews.index');
    }

    public function edit($id)
    {
        $clientReview = $this->clientReview->findOrFail($id);
        return view('backend.pages.client-review.create', compact('clientReview'));
    }

    public function update(Request $request, $id)
    {
        // if($request->hasFile('image')) {
        //     $image_path = $this->file($request->image, 'director', $request->name);
        // }
        // $request = new Request($request->all());
        // $request->merge(['image' => $image_path]);
        // $this->director->create($request->all());
        // return redirect()->route('directors.index');
        $this->clientReview->findOrFail($id)->update($request->validated());
        return redirect()->route('client-reviews.index');
    }

    public function destroy($id)
    {
        $this->clientReview->findOrFail($id)->delete();
        return back();
    }
}



