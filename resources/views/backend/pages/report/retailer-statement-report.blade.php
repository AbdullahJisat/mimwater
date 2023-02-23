@extends('backend.layouts.master')
@section('loan_active', 'active pcoded-trigger')
@section('view_loan_report_active', 'active')
@section('title', 'View loan Report')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <div style="float: left;">
                <label for="">Retailer : </label>
                <label>{{ $retailer->name }}</label>
            </div>
            <div style="float: right;">
                <label>Date : </label>
                <label>{{ $start }} to {{ $end }}</label>
            </div>
        </div>

        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>In</th>
                            <th>Out</th>
                            <th>Stock</th>
                            <th>Rate</th>
                            <th>Bill</th>
                            <th>Payment</th>
                            <th>Due</th>
                            <th>Discount</th>
                            <th>Date</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($retailer->statements as $statement)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $statement->in }}</td>
                            <td>{{ $statement->out }}</td>
                            <td>{{ $statement->stock }}</td>
                            <td>{{ $statement->rate }}</td>
                            <td>{{ $statement->bill }}</td>
                            <td>{{ $statement->payment }}</td>
                            <td>{{ $statement->due }}</td>
                            <td>{{ $statement->discount }}</td>
                            <td>{{ $statement->created_at->format('Y-m-d')}}</td>
                        </tr>
                        @empty
                        <td colspan="8">No loan available</td>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <th>Total</th>
                        <th>{{ $retailer->statements->sum('in') }}</th>
                        <th>{{ $retailer->statements->sum('out') }}</th>
                        <th>{{ $retailerStock }}</th>
                        <th colspan="1"></th>
                        <th>{{ $retailer->statements->sum('bill') }}</th>
                        <th>{{ $retailer->statements->sum('payment') }}</th>
                        <th>{{ $retailerDue }}</th>
                        <th colspan="1"></th>
                    </tfoot>
                </table>
            </div>
            {{-- {{ $retailer->statements->render() }} --}}
        </div>

    </div>
</div>
@endsection
