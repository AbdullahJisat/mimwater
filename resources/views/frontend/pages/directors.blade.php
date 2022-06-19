@extends('frontend.layouts.master')
@section('title', 'Directors')
@section('content')
<section class="content">
    @foreach ($departments as $department)
    <h1 style="text-align:center; color: #6EC1E4; font-weight: bold;font-family: Arial, Helvetica, sans-serif; margin-bottom: 50px;">{{ $department->name }}</h1>
    <div class="container">
        <div class="row d-flex justify-content-center">
            @foreach ($department->directors as $director)
            <div  class="col-lg-6 col-sm-12 d-flex justify-content-center text-center ">
                <div>
                    <img src="{{ (!empty($director->image)) ? $director->image : asset('noImage.png') }}"
                                style="width: 240px;height: 300px;">
                    <p style="margin-top: 10px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 19px; color: #747474;">{{ $director->name ?? "" }}</p>
                    <p style="margin-top: 10px; font-family: Arial, Helvetica, sans-serif; font-size: 19px; color: #747474;">{{ $director->designation->name ?? "" }}</p>
                </div>

            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</section>
@endsection
