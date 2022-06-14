@extends('backend.layouts.master')
@section('director_active', 'active pcoded-trigger')
@section('add_director_active', 'active')
@section('title', 'Add director')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('directors.index') }}" class="btn waves-effect waves-light btn-primary"><i
                    class="icofont icofont-user-alt-3"></i>{{ __('View director') }}</a>
        </div>
        <div class="card-block">
            <form id="directorForm" method="post" action="{{ (@$director) ? route('directors.update', $director->id) : route('directors.store') }}" novalidate>
                @csrf
                @method((@$director) ? 'PUT': 'POST')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name" value="{{ (@$director) ? $director->name :old('name') }}"/>
                        {{-- @if($errors->has('name'))
                            <span class="messages">{{ $errors->first('name') }}</span>
                        @endif --}}
                        @error('name')
                            <span class="messages">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="{{ (@$director) ? $director->email :old('email') }}" placeholder="Enter valid e-mail address" />
                            @if($errors->has('email'))
                                <span class="messages">{{ $errors->first('email') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Department</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="department_id" id="department_id">
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                            @endforeach
                        </select>
                        <div class="col-sm-2">
                        <a class="btn waves-effect waves-light btn-primary"  data-toggle="modal" href="#departmentModal"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                        </div>
                        @error('department_id')
                            <span class="messages">{{ $message }}</span>
                        @enderror
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
                    <label class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="Enter your number" class="form-control"
                            name="phone" id="phone" pattern="^(?:(?:\+|00)88|01)?\d{11}\r?$" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value="{{ (@$director) ? $director->phone :old('phone') }}" />
                            @if($errors->has('phone'))
                                <span class="messages">{{ $errors->first('phone') }}</span>
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
        $('#directorForm').validate({
            rules:{
                name:{
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
                name: {
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
