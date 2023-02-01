<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDealerRequest;
use App\Models\Dealer;
use Illuminate\Http\Request;
use Crypt;
use Illuminate\Support\Facades\Hash;

class DealerController extends Controller
{
    public function __construct(Dealer $dealer)
    {
        $this->dealer = $dealer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.dealer.index')->with('dealers', $this->dealer->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.dealer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDealerRequest $request)
    {
        $request = new Request($request->all());
        $request->merge(['password' => bcrypt($request->password)]);
        $this->dealer->create($request->all());
        return redirect()->route('dealers.index');
    }

    public function edit($id)
    {
        $dealer = $this->dealer->findOrFail($id);
        return view('backend.pages.dealer.create', compact('dealer'));
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
        $this->dealer->findOrFail($id)->update($request->except('password'));
        return redirect()->route('dealers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dealer->findOrFail($id)->delete();
        return back();
    }
}
