@extends('backend.layouts.master')
@section('clientReview_active', 'active pcoded-trigger')
@section('add_clientReview_active', 'active')
@section('title', 'Add clientReview')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('client-reviews.index') }}" class="btn waves-effect waves-light btn-primary"><i
                    class="icofont icofont-user-alt-3"></i>{{ __('View clientReview') }}</a>
        </div>
        <div class="card-block">
            <form id="clientReviewForm" method="post" action="{{ (@$clientReview) ? route('client-reviews.update', $clientReview->id) : route('client-reviews.store') }}" novalidate enctype="multipart/form-data">
                @csrf
                @method((@$clientReview) ? 'PUT': 'POST')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="client_name" id="client_name" placeholder="Enter Your Name" value="{{ (@$clientReview) ? $clientReview->client_name :old('client_name') }}"/>
                        {{-- @if($errors->has('name'))
                            <span class="messages">{{ $errors->first('name') }}</span>
                        @endif --}}
                        @error('client_name')
                            <span class="messages">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Company Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="company_name" name="company_name" value="{{ (@$clientReview) ? $clientReview->company_name :old('company_name') }}" placeholder="Enter your company name" />
                            @if($errors->has('company_name'))
                                <span class="messages">{{ $errors->first('company_name') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Designation</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="designation_id" id="designation_id">
                            @foreach ($designations as $designation)
                                <option value="{{ $designation->id }}" selected>{{ $designation->name }}</option>
                            @endforeach
                        </select>
                        <div class="col-sm-2">
                        <a class="btn waves-effect waves-light btn-primary"  data-toggle="modal" href="#designationModal"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                        </div>
                        @error('designation_id')
                            <span class="messages">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="image" id="image"/>
                        @if($errors->has('image'))
                            <span class="messages">{{ $errors->first('image') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Review</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="review" id="review" cols="30" rows="10">{{ (@$clientReview) ? $clientReview->review :old('review') }}</textarea>
                        @if($errors->has('review'))
                            <span class="messages">{{ $errors->first('review') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary m-b-0">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('backend.pages.department.create')
@include('backend.pages.designation.create')
@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script>
    $(document).ready(function (){
        $('#clientReviewForm').validate({
            rules:{
                client_name:{
                    required:true,
                },
                email:{
                    required:true,
                    email: true,
                },
                password:{
                    required:true,
                },
                username:{
                    required:true,
                },
                phone:{
                    required:true,
                    number: true,
                    min: 15,
                },
                nid:{
                    required:true,
                    number: true,
                },
                location:{
                    required:true,
                },
                status:{
                    required:true,
                },
            },
            message:{
                client_name: {
                    required: 'Name should be required',
                },
                email: {
                    email: "The email should be in the format: abc@domain.tld"
                },
                password: {
                    required: "Please enter your password",
                },
                username: {
                    required: 'Username should be required',
                },
                phone: {
                    required: "Please enter your number",
                    number: "Please enter your number as a numerical value",
                    min: "You must be at least 15 number"
                },
                phone: {
                    required: "Please enter your nid",
                    number: "Please enter your number as a numerical value",
                },
                location: {
                    required: "Please enter your location",
                },
                status: "Please enter your status",
            },
            errorElement:'span',
            errorPlacement: function(error, element){
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>
@endpush
