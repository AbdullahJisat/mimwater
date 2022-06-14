@extends('backend.layouts.master')
@section('report_active', 'active pcoded-trigger')
@section('view_report_active', 'active')
@section('title', 'View report')
@section('content')
<style>
    .salesText{
        text-align: center;
        padding: 10px;
        font-weight: bold;
    }
</style>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    @foreach ($salesmans as $salesman)
                        <h5 class="salesText">{{ $salesman->name }}</h5>
                        <table id="saleTbl" class="table table-striped table-bordered nowrap responsive">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salesman->stockItemPrices as $stockItem)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $stockItem->retailer->name }}</td>
                                    <td>{{ $stockItem->price }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">Total</th>
                                    <td colspan="3">{{ $income }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    @endforeach
                </div>
            </div>
            @if( count($salesmans) >= 1 )
            {{-- {!! $salesmans->links('pagination::bootstrap-4') !!} --}}
            {!! $salesmans->links() !!}
            @endif
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($costs as $cost)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $cost->category->name }}</td>
                                    <td>{{ $cost->amount }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Total</th>
                                <td colspan="3">{{ $expense }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
                                <td>{{ __("Income") }}</td>
                                <td>{{ $income }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("2") }}</td>
                                <td>{{ __("Expense") }}</td>
                                <td>{{ $expense }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Total</th>
                                <td colspan="3">{{ $totalProfit }}</td>
                            </tr>
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

