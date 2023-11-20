@extends('backend.layouts.master')
@section('report_active', 'active pcoded-trigger')
@section('view_report_active', 'active')
@section('title', 'View report')
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                {{-- <button type="button" class="btn waves-effect waves-light btn-primary" data-toggle="modal"
                    data-target="#stockOutItemModal"><i class="icofont icofont-user-alt-3"></i>{{ __('Add cash') }}</button>
                @include('backend.pages.stock-out-item.create') --}}
                <form action="{{ route('income_report_date') }}" method="get" style="display: inline-flex">
                    {{-- @csrf --}}
                    <div class="row input-daterange">
                        <div class="col-md-4">
                            <input type="date" class="form-control" name="start" id="">
                            @error('start')
                            <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="end" class="form-control" id="">
                            @error('end')
                            <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <input type="submit" value="Search" class="btn btn-primary" id="">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="card">
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="saleTbl" class="table table-striped table-bordered nowrap responsive">
                        <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    {{-- <th>Date</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Total Cash</td>
                                    <td>{{ $cashIncome }}</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Total Check</td>
                                    <td>{{ $checkIncome ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Total Office Bkash</td>
                                    <td>{{ $bkashIncome ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Total Bkash Ceo</td>
                                    <td>{{ $bkashCeoIncome ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Total PT Cash</td>
                                    <td>{{ $loan ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Total Sell Quantity</td>
                                    <td>{{ $totalStock ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Total Bill</td>
                                    <td>{{ $totalBill ?? 0 }}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">Total</th>
                                    <th>{{ $totalIncome ?? 0 }}</th>
                                </tr>
                            </tfoot>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="costTbl" class="table table-striped table-bordered nowrap responsive">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($costs as $cost)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $cost->category->name }}</td>
                                    <td>{{ $cost->amount }}</td>
                                    <td>{{ $cost->created_at->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Total</th>
                                <th>{{ $expense }}</th>
                            </tr>
                            <tr>
                                <th colspan="2">Pay to CEO</th>
                                <th>{{ $loanPay }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- @dd('cash',$cashInHand, 'total', $cashInHand - ($expense + $loanPay)) --}}
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap responsive">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ __("1") }}</td>
                                <td>{{ __("Cash Income") }}</td>
                                <td>{{ $cashIncome + $loan }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("2") }}</td>
                                <td>{{ __("Expense") }}</td>
                                <td>{{ $expense }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("3") }}</td>
                                <td>{{ __("Pay to CEO") }}</td>
                                <td>{{ $loanPay }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <form action="{{ route('daily_cash_hand_store') }}" method="post">
                                @csrf
                                <tr>
                                    <th colspan="2">Total cash in hand</th>
                                    <th>{{ $cashInHand }}
                                        <input type="hidden" name="dailyCashAmount" value="{{ $cashInHand}}">
                                    </th>
                                    <th><button type="submit" class="btn btn-sm btn-primary">Save</button></th>
                                </tr>
                            </form>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('script')
<script>
//     if ($.fn.DataTable.isDataTable('#saleTbl')) {
//     $('#saleTbl').DataTable().destroy();
// }
// $('#DatatableNone').dataTable({
//             "bDestroy": true
//         }).fnDestroy();
// $('#saleTbl tbody').empty();

// $('#saleTbl').dataTable().fnDestroy();
    // if($.fn.dataTable.isDataTable('#saleTbl')){
    $('#saleTbl').DataTable({
        "bDestroy": true,
        "fixedHeader": false,
        "lengthChange": false,
        "bPaginate": false,
        "responsive": false,
        "autoWidth": false,
        "scrollY": "300px",
        "scrollCollapse": true,
        "paging": false,
        // "bPaginate": true,
        "bFilter": false,
        "bInfo": false,
    }).fnDestroy();

    // }
    // $('#saleTbl').DataTable({
    // "fixedHeader": false,
    // "lengthChange": false,
    // "bPaginate": false,
    // "responsive": false,
    // "autoWidth": false,
    // "scrollY": "300px",
    // "scrollCollapse": true,
    // "paging": false,
    // // "bPaginate": true,
    // "bFilter": false,
    // "bInfo": false,
    // });
</script>
<script>
    $('#costTbl').DataTable({
        "bDestroy": true,
        "fixedHeader": false,
        "lengthChange": false,
        "bPaginate": false,
        "responsive": false,
        "autoWidth": false,
        "scrollY": "300px",
        "scrollCollapse": true,
        "paging": true,
        // "bPaginate": true,
        "bFilter": false,
        "bInfo": false,
    }).fnDestroy();
</script>
@endpush
