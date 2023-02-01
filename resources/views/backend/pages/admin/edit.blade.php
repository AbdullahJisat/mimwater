@extends('backend.layouts.master')
@section('admin_active', 'active pcoded-trigger')
@section('admin_active', 'active pcoded-trigger')
@section('add_admin_active', 'active')
@section('title', 'Add admin')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admins.index') }}" class="btn waves-effect waves-light btn-primary"><i
                    class="icofont icofont-user-alt-3"></i>{{ __('View admin') }}</a>
        </div>
        <div class="card-block">
            <form id="adminForm" method="post"
                action="{{ (@$admin) ? route('admins.update', $admin->id) : route('admins.store') }}" novalidate>
                @csrf
                @method((@$admin) ? 'PUT': 'POST')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name"
                            value="{{ (@$admin) ? $admin->name :old('name') }}" />
                        @if($errors->has('name'))
                        <span class="messages">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ (@$admin) ? $admin->email :old('email') }}"
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
                    <label class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select name="roles[]" id="" class="form-control" multiple>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ collect($admin->roles()->pluck('id'))->contains($role->id) ? "selected" : "" }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
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
