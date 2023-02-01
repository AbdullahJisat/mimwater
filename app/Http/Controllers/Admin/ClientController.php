<?php

namespace App\Http\Controllers\Admin;

use App\Helper\File;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    use File;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        return view('backend.pages.client.index')->with('clients', $this->client->all());
    }

    public function store(Request $request)
    {
        if($request->hasFile('image')) {
            foreach($request->image as $key => $image){
            // $filename = 'client'.'-'.'image'.'-'.$key+1.'.'.$image->getClientOriginalExtension();
            $filename = 'client-image'.'-'.$key.$image->getClientOriginalExtension();
            $image_path = str_ireplace("public/","/storage/", $image->storeAs('public/upload/'.'client_image', $filename));
            $this->client->create(['image' => $image_path]);
            }   
        }
        return redirect()->route('clients.index');
    }

    public function edit($id)
    {
        $client = $this->client->findOrFail($id);
        return view('Client.create', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $this->client->findOrFail($id)->update($request->validated());
        return redirect()->route('clients.index');
    }

    public function destroy($id)
    {
        $this->client->findOrFail($id)->delete();
        return back();
    }
}







