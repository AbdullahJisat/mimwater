@extends('backend.layouts.master')
@section('loan_active', 'active pcoded-trigger')
@section('view_loan_report_active', 'active')
@section('title', 'View loan Report')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <div style="float: left;">
                <label for="">Dealer :rrrr </label>
                <label>{{ $dealer->name }}</label>
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
                        @forelse ($dealer->statements as $statement)
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
                        <th>{{ $dealer->statements->sum('in') }}</th>
                        <th>{{ $dealer->statements->sum('out') }}</th>
                        ` <th>{{ $dealerStock }}</th>
                        <th colspan="1"></th>
                        <th>{{ $dealer->statements->sum('bill') }}</th>
                        <th>{{ $dealer->statements->sum('payment') }}</th>
                        <th>{{ $dealer->statements->sum('bill')- ($dealer->statements->sum('payment') +  $dealer->statements->sum('discount') )}}</th>
                        <th>{{ $dealer->statements->sum('discount') }}</th>
                        <th colspan="1"></th>
                    </tfoot>
                </table>
            </div>
            {{-- {{ $dealer->statements->render() }} --}}
        </div>

    </div>
</div>
@endsection
