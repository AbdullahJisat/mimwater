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
                        <h4 class="card-title">gallary List</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Serial No </th>
                                        <th>Gallary Image </th>
                                        <th>Seo Keyword</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                    
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach($gallarys as $gallary)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td><img src="{{ asset($gallary->gallary_image) }}"
                                                style="width: 100px; height: 100px;"></td>
                                        <td>{{ $gallary->seo_key }}</td>
                                      
                                    
                                        @if($gallary->status == 1)
                                        <td><span class="badge badge-success">Active</span></td>
                                        @else
                                        <td><span class="badge badge-danger">Inactive</span></td>
                                        @endif
                                        <td>
                                            @if($gallary->status == 1) <a
                                                href="{{ URL::to('gallary/change_status/'.$gallary->id) }}"><i
                                                    class="fa fa-arrow-circle-down"></i></a>@else<a
                                                href="{{ URL::to('gallary/change_status/'.$gallary->id) }}"><i
                                                    class="fa fa-arrow-circle-up"></i></a>@endif <a
                                                href="{{ URL::to('gallary/delete/'.$gallary->id) }}" id="delete"><i
                                                    class="fa fa-trash"></i></a>
                                                    <a href="{{ URL::to('gallary/edit/'.$gallary->id) }}"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

@endsection