@extends('backend.layouts.master')
@section('admin_active', 'active pcoded-trigger')
@section('salesman_active', 'active pcoded-trigger')
@section('view_salesman_active', 'active')
@section('title', 'View Retailers')
@section('content')
<div class="col-sm-12">
    <div class="card">
        {{-- <div class="card-header">
            <a href="{{ route('salesmans.create') }}" class="btn waves-effect waves-light btn-primary"><i class="icofont icofont-user-alt-3"></i>{{ __('Add Salesman') }}</a>
        </div> --}}
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th>Nid</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($salesman->retailers as $retailer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $retailer->name }}</td>
                                <td>{{ $retailer->email }}</td>
                                <td>{{ $retailer->username }}</td>
                                <td>{{ $retailer->phone }}</td>
                                <td>{{ $retailer->location }}</td>
                                <td>{{ $retailer->nid }}</td>
                            </tr>
                        @empty
                            <td colspan="8">No Salesman available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
