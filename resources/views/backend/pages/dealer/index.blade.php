@extends('backend.layouts.master')
@section('admin_active', 'active pcoded-trigger')
@section('dealer_active', 'active pcoded-trigger')
@section('view_dealer_active', 'active')
@section('title', 'View dealer')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('dealers.create') }}" class="btn waves-effect waves-light btn-primary"><i class="icofont icofont-user-alt-3"></i>{{ __('Add dealer') }}</a>
        </div>
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
                            <th>Shop Name</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dealers as $dealer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dealer->name }}</td>
                                <td>{{ $dealer->email }}</td>
                                <td>{{ $dealer->username }}</td>
                                <td>{{ $dealer->phone }}</td>
                                <td>{{ $dealer->location }}</td>
                                <td>{{ $dealer->nid }}</td>
                                <td>{{ $dealer->shopname }}</td>
                                <td>{{ $dealer->password }}</td>
                                <td>
                                    <form action="{{route('dealers.destroy',$dealer->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('dealers.edit',$dealer->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <td colspan="8">No dealer available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
