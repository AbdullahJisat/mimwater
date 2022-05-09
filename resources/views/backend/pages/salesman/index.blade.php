@extends('backend.layouts.master')
@section('admin_active', 'active pcoded-trigger')
@section('salesman_active', 'active pcoded-trigger')
@section('view_salesman_active', 'active')
@section('title', 'View Salesman')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('salesmans.create') }}" class="btn waves-effect waves-light btn-primary"><i class="icofont icofont-user-alt-3"></i>{{ __('Add Salesman') }}</a>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th>Nid</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($salesmans as $salesman)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $salesman->name }}</td>
                                <td>{{ $salesman->email }}</td>
                                <td>{{ $salesman->username }}</td>
                                <td>{{ $salesman->phone }}</td>
                                <td>{{ $salesman->location }}</td>
                                <td>{{ $salesman->nid }}</td>
                                <td>{{ $salesman->password }}</td>
                                <td><button class="btn waves-effect waves-light btn-primary"><i class="icofont icofont-user-alt-3"></i></button>
                                    <button class="btn waves-effect waves-light btn-success"><i class="icofont icofont-check-circled"></i></button></td>
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
