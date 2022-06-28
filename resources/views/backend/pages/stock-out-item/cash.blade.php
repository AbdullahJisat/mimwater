@extends('backend.layouts.master')
@section('cash_active', 'active pcoded-trigger')
@section('view_cash_active', 'active')
@section('title', 'View cash')
@push('css')
@endpush
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            {{-- <button type="button" class="btn waves-effect waves-light btn-primary"  data-toggle="modal" data-target="#stockOutItemModal"><i class="icofont icofont-user-alt-3"></i>{{ __('Add cash') }}</button>
            @include('backend.pages.stock-out-item.create') --}}
            <form action="{{ route('show_cash_by_date') }}" method="post" style="display: inline-flex">
                @csrf
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
                <table class="table table-striped table-bordered nowrap responsive">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Retailer Name</th>
                            <th>Salesman Name</th>
                            <th>cash</th>
                            <th>due</th>
                            <th>total</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cashes as $cash)
                            <tr>
                                <td data-label="SL">{{ $loop->iteration }}</td>
                                <td data-label="Name">{{ $cash->retailer->name }}</td>
                                <td data-label="Name">{{ $cash->salesman->name }}</td>
                                <td data-label="Quantity">{{ $cash->amount }}</td>
                                <td data-label="Quantity">{{ $cash->due }}</td>
                                <td data-label="Quantity">{{ $cash->total }}</td>
                                <td data-label="Quantity">{{ $cash->created_at->format('Y-m-d') }}</td>
                                {{-- <td data-label="Action">
                                    <form action="{{route('cashs.destroy',$cash->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('cashs.edit',$cash->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td> --}}
                            </tr>
                        @empty
                            <td colspan="8">No cash available</td>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Total</td>
                            <td></td>
                            <td>{{ $amountTotal }}</td>
                            <td>{{ $duesTotal }}</td>
                            <td>{{ $cashesTotal }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
