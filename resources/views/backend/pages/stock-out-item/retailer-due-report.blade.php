@extends('backend.layouts.master')
@section('due_active', 'active pcoded-trigger')
@section('view_due_active', 'active')
@section('title', 'View due')
@push('css')
@endpush
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            {{-- <button type="button" class="btn waves-effect waves-light btn-primary"  data-toggle="modal" data-target="#stockOutItemModal"><i class="icofont icofont-user-alt-3"></i>{{ __('Add due') }}</button>
            @include('backend.pages.stock-out-item.create') --}}
            <form action="{{ route('retailer.invoices.dues_report_date') }}" method="get" style="display: inline-flex">
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
                <table class="table table-striped table-bordered nowrap responsive">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Retailer Name</th>
                            <th>Salesman Name</th>
                            <th>Due</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dues as $due)
                            <tr>
                                <td data-label="SL">{{ $loop->iteration }}</td>
                                <td data-label="Name">{{ $due->retailer->name }}</td>
                                <td data-label="Name">{{ $due->salesman->name ?? "" }}</td>
                                <td data-label="Quantity">{{ $due->due }}</td>
                                <td data-label="Quantity">{{ $due->created_at->format('Y-m-d') }}</td>
                                {{-- <td data-label="Action">
                                    <form action="{{route('dues.destroy',$due->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('dues.edit',$due->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td> --}}
                            </tr>
                        @empty
                            <td colspan="8">No due available</td>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <td colspan="2">Total:</td>
                        <td>{{ $duesTotal }}</td>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
