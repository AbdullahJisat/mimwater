@extends('backend.layouts.master')
@section('cost_active', 'active pcoded-trigger')
@section('view_cost_active', 'active')
@section('title', 'View cost')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn waves-effect waves-light btn-primary"  data-toggle="modal" data-target="#costModal"><i class="icofont icofont-user-alt-3"></i>{{ __('Add cost') }}</button>
            @include('backend.pages.cost.create')
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table class="table table-striped table-bordered nowrap responsive">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($costs as $cost)
                            <tr>
                                <td data-label="SL">{{ $loop->iteration }}</td>
                                <td data-label="Name">{{ $cost->category->name }}</td>
                                <td data-label="Quantity">{{ $cost->amount }}</td>
                                {{-- <td data-label="Action">
                                    <form action="{{route('costs.destroy',$cost->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('costs.edit',$cost->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td> --}}
                            </tr>
                        @empty
                            <td colspan="8">No cost available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
