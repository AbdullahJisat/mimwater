@extends('backend.layouts.master')
@section('item_active', 'active pcoded-trigger')
@section('view_item_active', 'active')
@section('title', 'View item')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn waves-effect waves-light btn-primary"  data-toggle="modal" data-target="#itemModal"><i class="icofont icofont-user-alt-3"></i>{{ __('Add item') }}</button>
            @include('backend.pages.item.create')
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="itemTbl" class="table table-striped table-bordered nowrap responsive">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td data-label="SL">{{ $loop->iteration }}</td>
                                <td data-label="Name">{{ $item->name }}</td>
                                <td data-label="Image"><img src="{{ (!empty($item->image)) ? $item->image : asset('noImage.png') }}" style="width: 50px;height: 50px;"></td>
                                <td data-label="Action">
                                    <form action="{{route('items.destroy',$item->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('items.edit',$item->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <td colspan="8">No item available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
