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
            <button type="button" class="btn waves-effect waves-light btn-primary"  data-toggle="modal" data-target="#stockOutItemModal"><i class="icofont icofont-user-alt-3"></i>{{ __('Add due') }}</button>
            @include('backend.pages.stock-out-item.create')
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table class="table table-striped table-bordered nowrap responsive">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Retailer Name</th>
                            <th>Due</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dues as $due)
                            <tr>
                                <td data-label="SL">{{ $loop->iteration }}</td>
                                <td data-label="Name">{{ $due->retailer->name }}</td>
                                <td data-label="Quantity">{{ $due->due }}</td>
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
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
