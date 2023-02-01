@extends('backend.layouts.master')
@section('client_active', 'active pcoded-trigger')
@section('view_client_active', 'active')
@section('title', 'View client')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn waves-effect waves-light btn-primary"  data-toggle="modal" data-target="#clientModal"><i class="icofont icofont-user-alt-3"></i>{{ __('Add client') }}</button>
            @include('backend.pages.client.create')
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table class="table table-striped table-bordered nowrap responsive">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                           <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clients as $client)
                            <tr>
                                <td data-label="SL">{{ $loop->iteration }}</td>
                                <td data-label="Name"><img src="{{ (!empty($client->image)) ? $client->image : asset('noImage.png') }}"
                                    style="width: 50px;height: 50px;border: 1px solid #000;"></td>
                               <td data-label="Action">
                                    <form action="{{route('clients.destroy',$client->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('clients.edit',$client->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td> 
                            </tr>
                        @empty
                            <td colspan="8">No client available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
