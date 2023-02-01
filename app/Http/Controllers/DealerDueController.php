<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class DealerDueController extends Controller
{
    public function editDealerDue($id) {
        $dealers = allDealer();
        $due = Payment::findOrFail($id);
        return view('backend.pages.due.edit-dealer-due', compact('due', 'dealers'));
    }

    public function updateDealerDue(Request $request, $id) {
        $due = Payment::findOrFail($id)->update($request->all());
        return redirect('dealer-dues');
    }
}
