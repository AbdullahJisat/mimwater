@extends('backend.layouts.master')
@section('request_bottle_active', 'active pcoded-trigger')
@section('view_request_bottle_active', 'active')
@section('title', 'View request_bottle')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn waves-effect waves-light btn-primary"  data-toggle="modal" data-target="#requestBottleModal"><i class="icofont icofont-user-alt-3"></i>{{ __('Add request_bottle') }}</button>
            @include('backend.pages.request-bottle.create')
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
                        @forelse ($requestBottles as $requestBottle)
                            <tr>
                                <td data-label="SL">{{ $loop->iteration }}</td>
                                <td data-label="Name">{{ $requestBottle->item->name }}</td>
                                <td data-label="Quantity">{{ $requestBottle->quantity }}</td>
                                {{-- <td data-label="Action">
                                    <form action="{{route('request_bottles.destroy',$request_bottle->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('request_bottles.edit',$request_bottle->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td> --}}
                            </tr>
                        @empty
                            <td colspan="8">No request_bottle available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
