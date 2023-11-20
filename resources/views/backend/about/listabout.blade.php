@extends('backend.layouts.master')
@section('content')



    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row" >
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">about List</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Serial No </th>
                                        <th>Image </th>
                                        <th>Description</th>
                                       
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                    
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach($abouts as $about)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td><img src="{{ asset($about->image) }}"
                                                style="width: 100px; height: 100px;"></td>
                                        <td>{{ $about->description }}</td>
                                      
                                    
                                    
                                        <td>    
                                                    <a  class="btn btn-primary" href="{{ route('about.edit', $about->id) }}"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                             
                            </table>
                            {{ $abouts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

@endsection