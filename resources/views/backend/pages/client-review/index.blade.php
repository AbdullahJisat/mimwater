@extends('backend.layouts.master')
@section('clientReview_active', 'active pcoded-trigger')
@section('view_clientReview_active', 'active')
@section('title', 'View clientReview')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('client-reviews.create') }}" class="btn waves-effect waves-light btn-primary"><i class="icofont icofont-user-alt-3"></i>{{ __('Add clientReview') }}</a>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Image</th>
                            <th>Company Name</th>
                            <th>Review</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clientReviews as $clientReview)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $clientReview->client_name }}</td>
                                <td>{{ $clientReview->designation->name }}</td>
                                <td><img src="{{ (!empty($clientReview->image)) ? $clientReview->image : asset('noImage.png') }}" style="width: 50px;height: 50px;"></td>
                                <td>{{ $clientReview->company_name }}</td>
                                <td>{{ $clientReview->review }}</td>
                                <td>
                                    <form action="{{route('client-reviews.destroy',$clientReview->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('client-reviews.edit',$clientReview->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <td colspan="8">No clientReview available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
