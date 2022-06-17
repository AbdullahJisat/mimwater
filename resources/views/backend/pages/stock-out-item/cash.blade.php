@extends('backend.layouts.master')
@section('cash_active', 'active pcoded-trigger')
@section('view_cash_active', 'active')
@section('title', 'View cash')
@push('css')
@endpush
@section('content')
<div class="col-sm-12">
    <div class="card">
        {{-- <div class="card-header">
            <button type="button" class="btn waves-effect waves-light btn-primary"  data-toggle="modal" data-target="#stockOutItemModal"><i class="icofont icofont-user-alt-3"></i>{{ __('Add cash') }}</button>
            @include('backend.pages.stock-out-item.create')
        </div> --}}
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table class="table table-striped table-bordered nowrap responsive">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Retailer Name</th>
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
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
