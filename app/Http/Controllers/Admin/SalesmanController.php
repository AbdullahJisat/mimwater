<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSalesmanRequest;
use App\Models\Salesman;
use Illuminate\Http\Request;

class SalesmanController extends Controller
{
    public function retailersBySalesman($id)
    {
        $salesman = Salesman::with('retailers')->findOrFail($id);
        return view('backend.pages.salesman.retailers', compact('salesman'));
    }

    public function index()
    {
        return view('backend.pages.salesman.index', ['salesmans' => Salesman::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.salesman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSalesmanRequest $request)
    {
        $request = new Request($request->all());
        $request->merge(['password' => bcrypt($request->password)]);
        Salesman::create($request->all());
        return redirect()->route('salesmans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salesman = Salesman::findOrFail($id);
        return view('backend.pages.salesman.create', compact('salesman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Salesman::findOrFail($id)->update($request->except('password'));
        return redirect()->route('salesmans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Salesman::findOrFail($id)->delete();
        return back();
    }
}
