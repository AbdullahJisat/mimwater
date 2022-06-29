@extends('backend.layouts.master')
@section('productionFacilities_active', 'active pcoded-trigger')
@section('view_productionFacilities_active', 'active')
@section('title', 'View productionFacilities')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn waves-effect waves-light btn-primary"  data-toggle="modal" data-target="#productionFacilitiesModal"><i class="icofont icofont-user-alt-3"></i>{{ __('Add productionFacilities') }}</button>
            @include('backend.pages.production-facilities.create')
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table class="table table-striped table-bordered nowrap responsive">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productionFacilities as $productionFacilities)
                            <tr>
                                <td data-label="SL">{{ $loop->iteration }}</td>
                                <td data-label="Name"><img src="{{ (!empty($productionFacilities->image)) ? $productionFacilities->image : asset('noImage.png') }}"
                                    style="width: 50px;height: 50px;border: 1px solid #000;"></td>
                                {{-- <td data-label="Action">
                                    <form action="{{route('productionFacilities.destroy',$productionFacilities->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('productionFacilities.edit',$productionFacilities->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td> --}}
                            </tr>
                        @empty
                            <td colspan="8">No productionFacilities available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
