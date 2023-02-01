<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function __construct(Loan $loan)
    {
        $this->loan = $loan;
    }

    public function index() {
        $loans = $this->loan->whereType(1)->get();
        return view('backend.pages.loan.index', ['loans' => $loans]);
    }

    public function payIndex() {
        $loans = $this->loan->whereType(0)->get();
        return view('backend.pages.loan.pay-index', ['loans' => $loans]);
    }

    public function store(Request $request) {
        $data = new Loan();
        $data->amount = $request->amount;
        $data->save();
        return response()->json($data);
    }

    public function payStore(Request $request) {
        // $loan = Loan::whereType(1)->latest()->first();
        // if ($request->amount >= $loan->amount) {
        //     $loan->profit = abs($request->amount - $loan->amount);
        // } else {
        //     $loan->amount = abs($request->amount - $loan->amount);
        //     $loan->profit = 0;
        //     $loan->type = 1;
        // }
        // $loan->save();

        $data = new Loan();
        $data->amount = $request->amount;
        $data->type = 0;
        $data->save();
        return response()->json($data);
    }

    public function destroy($id) {
        $data = Loan::findOrFail($id);
        $data->delete();
        return response()->json('delete successful');
    }

    public function loanReport() {
        $loans = $this->loan;
        return view('backend.pages.loan.report', ['loans' => $loans]);
    }
}
