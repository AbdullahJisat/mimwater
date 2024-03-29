@extends('backend.layouts.master')
@section('dealer_active', 'active pcoded-trigger')
@section('add_dealer_active', 'active')
@section('title', 'Add Dealer')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('dealers.index') }}" class="btn waves-effect waves-light btn-primary"><i
                    class="icofont icofont-user-alt-3"></i>{{ __('View dealer') }}</a>
        </div>
        <div class="card-block">
            <form id="dealerForm" method="post" action="{{ (@$dealer) ? route('dealers.update', $dealer->id) : route('dealers.store') }}" novalidate>
                @csrf
                @method((@$dealer) ? 'PUT': 'POST')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name" value="{{ (@$dealer) ? $dealer->name :old('name') }}"/>
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
                        <input type="email" class="form-control" id="email" name="email" value="{{ (@$dealer) ? $dealer->email :old('email') }}" placeholder="Enter valid e-mail address" />
                            @if($errors->has('email'))
                                <span class="messages">{{ $errors->first('email') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Password input">
                            @if($errors->has('password'))
                                <span class="messages">{{ $errors->first('password') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="username" id="username" value="{{ (@$dealer) ? $dealer->username :old('username') }}" placeholder="Enter Your Username" />
                            @if($errors->has('username'))
                                <span class="messages">{{ $errors->first('username') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="Enter your number" class="form-control"
                            name="phone" id="phone" pattern="^(?:(?:\+|00)88|01)?\d{11}\r?$" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" value="{{ (@$dealer) ? $dealer->phone :old('phone') }}" />
                            @if($errors->has('phone'))
                                <span class="messages">{{ $errors->first('phone') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nid</label>
                    <div class="col-sm-10">
                            <input type="text" class="form-control" name="nid" id="nid" pattern="[1-9]{1}[0-9]{9}" placeholder="Enter your nid"
                            title="Enter nid number" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" {{ old('nid') }} value="{{ (@$dealer) ? $dealer->nid :old('nid') }}" />
                            @if($errors->has('nid'))
                                <span class="messages">{{ $errors->first('nid') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                            <input type="text" class="form-control" name="location" id="location"
                            title="Enter your location" placeholder="Enter your location" value="{{ (@$dealer) ? $dealer->location :old('location') }}"/>
                            @if($errors->has('location'))
                                <span class="messages">{{ $errors->first('location') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Shopname</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="shopname" id="shopname" value="{{ (@$dealer) ? $dealer->shopname :old('shopname') }}" placeholder="Enter Your shopname" />
                            @if($errors->has('shopname'))
                                <span class="messages">{{ $errors->first('shopname') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">shop_location</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="shop_location" id="shop_location" value="{{ (@$dealer) ? $dealer->shop_location :old('shop_location') }}" placeholder="Enter Your shop_location" />
                            @if($errors->has('shop_location'))
                                <span class="messages">{{ $errors->first('shop_location') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="price" id="price" value="{{ (@$dealer) ? $dealer->price :old('price') }}" placeholder="Enter Your price" />
                            @if($errors->has('price'))
                                <span class="messages">{{ $errors->first('price') }}</span>
                            @endif
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="status" id="status" {{ @$dealer->status == 1 ? 'checked' : ''}} value="1"> Active
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="status" id="status"
                                    value="0" {{ @$dealer->status == 0 ? 'checked' : ' ' }}> Inactive
                            </label>
                        </div>
                        @if($errors->has('status'))
                            <span class="messages">{{ $errors->first('status') }}</span>
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
@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script>
    $(document).ready(function (){
        $('#dealerForm').validate({
            rules:{
                name:{
                    required:true,
                },
                email:{
                    required:true,
                    email: true,
                },
                // password:{
                //     required:true,
                // },
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
