@extends('backend.layouts.master')
@section('role_active', 'active pcoded-trigger')
@section('add_role_active', 'active')
@section('title', 'Add role')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('roles.index') }}" class="btn waves-effect waves-light btn-primary"><i
                    class="icofont icofont-user-alt-3"></i>{{ __('View role') }}</a>
        </div>
        <div class="card-block">
            <form id="roleForm" method="post" action="{{ (@$role) ? route('roles.update', $role->id) : route('roles.store') }}" novalidate>
                @csrf
                @method((@$role) ? 'PUT': 'POST')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name" value="{{ (@$role) ? $role->name :old('name') }}"/>
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
                        @foreach($permissions as $permission)
                            <label for="">
                                <input type="checkbox" class="form-control" id="email" name="permission[]"/>
                                {{ $permission->name }}
                            </label>
                            <br/>
                        @endforeach
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

