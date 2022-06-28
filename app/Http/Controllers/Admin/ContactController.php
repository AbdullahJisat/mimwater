<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function index()
    {
        return view('backend.pages.contact.index')->with(['unreadMessages' => $this->contact->whereRead(0)->get(), 'readMessages' => $this->contact->whereRead(1)->get()]);
    }


    public function store(Request $request)
    {
        $request = new Request($request->all());
        $request->merge(['read' => 0]);
        $this->contact->create($request->all());
        return redirect()->route('contact')->with('Message sent');
    }

    public function edit($id)
    {
        $contact = $this->contact->findOrFail($id);
        return view('contact.create', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $this->contact->findOrFail($id)->update($request->validated());
        return redirect()->route('contacts.index');
    }

    public function destroy($id)
    {
        $this->contact->findOrFail($id)->delete();
        return back();
    }

    public function contactRead($id)
    {
        $contact = $this->contact->findOrFail($id);
        $contact->update(['read' => 1]);
        return back();
    }
}



