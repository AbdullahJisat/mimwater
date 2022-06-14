<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Director;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function __construct(Director $director, Department $department, Designation $designation)
    {
        $this->director = $director;
        $this->department = $department;
        $this->designation = $designation;
        view()->share(['departments' => $this->department->all(), 'designations' => $this->designation->all()]);
    }

    public function index()
    {
        return view('backend.pages.director.index')->with('directors', $this->director->all());
    }

    public function departmentStore(Request $request)
    {
        $this->department->create($request->all());
        return back();
    }

    public function designationStore(Request $request)
    {
        $this->designation->create($request->all());
        return back();
    }

    public function create()
    {
        return view('backend.pages.director.create');
    }

    public function store(Request $request)
    {
        $this->director->create($request->all());
        return redirect()->route('directors.index');
    }

    public function edit($id)
    {
        $director = $this->director->findOrFail($id);
        return view('backend.pages.director.create', compact('director'));
    }

    public function update(Request $request, $id)
    {
        $this->director->findOrFail($id)->update($request->all());
        return redirect()->route('directors.index');
    }

    public function destroy($id)
    {
        $this->director->findOrFail($id)->delete();
        return back();
    }
}



