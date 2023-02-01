@extends('backend.layouts.master')
@section('statement_active', 'active pcoded-trigger')
@section('view_statement_report_active', 'active')
@section('title', 'View statement Report')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <form action="{{ route('date_dealer_statements') }}" method="get" style="display: inline-flex">
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

        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Dealer Name</th>
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
                        @forelse ($dailyStatement as $statement)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $statement->dealer->name }}</td>
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
                        <td colspan="8">No statement available</td>
                        @endforelse
                    </tbody>
                    {{-- <tfoot>
                        <th>Total</th>
                        <th>{{ $dealer->statements->sum('in') }}</th>
                        <th>{{ $dealer->statements->sum('out') }}</th>
                        ` <th>{{ $dealerStock }}</th>
                        <th colspan="1"></th>
                        <th>{{ $dealer->statements->sum('bill') }}</th>
                        <th>{{ $dealer->statements->sum('payment') }}</th>
                        <th>{{ $dealerDue }}</th>
                        <th colspan="1"></th>
                    </tfoot> --}}
                </table>
            </div>
            {{-- {{ $dealer->statements->render() }} --}}
        </div>

    </div>
</div>
@endsection
