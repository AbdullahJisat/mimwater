@extends('backend.layouts.master')
@section('loan_active', 'active pcoded-trigger')
@section('view_loan_report_active', 'active')
@section('title', 'View loan Report')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">Profit / Loss : </div>
        <p>{{ $loans->whereType(0)->sum('amount') - $loans->whereType(1)->sum('amount')  }}</p>
    </div>
</div>
<div class="col-sm-6">
    <div class="card">
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Amount Pay</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="loanBody">
                        @forelse ($loans->whereType(0)->get() as $loan)
                            <tr class="item{{$loan->id}}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $loan->amount }}</td>
                                <td>{{$loan->created_at->format('Y-m-d')}}</td>
                                <td>
                                    {{-- <form action="{{route('loans.destroy',$loan->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf --}}
                                        {{-- <a href="{{route('loans.edit',$loan->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a> --}}
                                        <button data-id="{{$loan->id}}" id=""
                                            data-name="{{$loan->amount}}" class="deleteLoan btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    {{-- </form> --}}
                                </td>
                            </tr>
                        @empty
                            <td colspan="8">No loan available</td>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <th>Total</th>
                        <th>{{ $loans->whereType(0)->sum('amount') }}</th>
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
                <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Amount Given</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="loanBody">
                        @forelse ($loans->whereType(1)->get() as $loan)
                            <tr class="item{{$loan->id}}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $loan->amount }}</td>
                                <td>{{$loan->created_at->format('Y-m-d')}}</td>
                                <td>
                                    {{-- <form action="{{route('loans.destroy',$loan->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf --}}
                                        {{-- <a href="{{route('loans.edit',$loan->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a> --}}
                                        <button data-id="{{$loan->id}}" id=""
                                            data-name="{{$loan->amount}}" class="deleteLoan btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    {{-- </form> --}}
                                </td>
                            </tr>
                        @empty
                            <td colspan="8">No loan available</td>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <th>Total</th>
                        <th>{{ $loans->whereType(1)->sum('amount') }}</th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
