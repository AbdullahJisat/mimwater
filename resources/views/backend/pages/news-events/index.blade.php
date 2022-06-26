@extends('backend.layouts.master')
@section('newsEvents_active', 'active pcoded-trigger')
@section('view_newsEvents_active', 'active')
@section('title', 'View newsEvents')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn waves-effect waves-light btn-primary"  data-toggle="modal" data-target="#newsEventsModal"><i class="icofont icofont-user-alt-3"></i>{{ __('Add newsEvents') }}</button>
            @include('backend.pages.news-events.create')
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
                        @forelse ($newsEvents as $newsEvent)
                            <tr>
                                <td data-label="SL">{{ $loop->iteration }}</td>
                                <td data-label="Name"><img src="{{ (!empty($newsEvent->picture)) ? $newsEvent->picture : asset('noImage.png') }}"
                                    style="width: 50px;height: 50px;border: 1px solid #000;"></td>
                                {{-- <td data-label="Action">
                                    <form action="{{route('newsEvents.destroy',$newsEvents->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('newsEvents.edit',$newsEvents->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td> --}}
                            </tr>
                        @empty
                            <td colspan="8">No newsEvents available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
