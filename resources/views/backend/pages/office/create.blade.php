@extends('backend.layouts.master')
@section('manager_active', 'active pcoded-trigger')
@section('manager_active', 'active pcoded-trigger')
@section('add_manager_active', 'active')
@section('title', 'Add manager')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('managers.index') }}" class="btn waves-effect waves-light btn-primary"><i
                    class="icofont icofont-user-alt-3"></i>{{ __('View manager') }}</a>
        </div>
        <div class="card-block">
            <form id="managerForm" method="post"
                action="{{ (@$manager) ? route('managers.update', $manager->id) : route('managers.store') }}" novalidate>
                @csrf
                @method((@$manager) ? 'PUT': 'POST')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name"
                            value="{{ (@$manager) ? $manager->name :old('name') }}" />
                        @if($errors->has('name'))
                        <span class="messages">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ (@$manager) ? $manager->email :old('email') }}"
                            placeholder="Enter valid e-mail address" />
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
