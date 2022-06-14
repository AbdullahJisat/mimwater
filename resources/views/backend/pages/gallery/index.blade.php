@extends('backend.layouts.master')
@section('gallery_active', 'active pcoded-trigger')
@section('view_gallery_active', 'active')
@section('title', 'View gallery')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn waves-effect waves-light btn-primary"  data-toggle="modal" data-target="#galleryModal"><i class="icofont icofont-user-alt-3"></i>{{ __('Add gallery') }}</button>
            @include('backend.pages.gallery.create')
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
                        @forelse ($galleries as $gallery)
                            <tr>
                                <td data-label="SL">{{ $loop->iteration }}</td>
                                <td data-label="Name"><img src="{{ (!empty($gallery->picture)) ? $gallery->picture : asset('noImage.png') }}"
                                    style="width: 50px;height: 50px;border: 1px solid #000;"></td>
                                {{-- <td data-label="Action">
                                    <form action="{{route('galleries.destroy',$gallery->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('galleries.edit',$gallery->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td> --}}
                            </tr>
                        @empty
                            <td colspan="8">No gallery available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
