@extends('backend.layouts.master')
@section('director_active', 'active pcoded-trigger')
@section('view_director_active', 'active')
@section('title', 'View director')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('directors.create') }}" class="btn waves-effect waves-light btn-primary"><i class="icofont icofont-user-alt-3"></i>{{ __('Add director') }}</a>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($directors as $director)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $director->name }}</td>
                                <td>{{ $director->email }}</td>
                                <td>{{ $director->phone }}</td>
                                <td>
                                    <form action="{{route('directors.destroy',$director->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('directors.edit',$director->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <td colspan="8">No director available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
