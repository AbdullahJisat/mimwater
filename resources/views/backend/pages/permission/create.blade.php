@extends('backend.layouts.master')
@section('permission_active', 'active pcoded-trigger')
@section('add_permission_active', 'active')
@section('title', 'Add permission')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('permissions.index') }}" class="btn waves-effect waves-light btn-primary"><i
                    class="icofont icofont-user-alt-3"></i>{{ __('View permission') }}</a>
        </div>
        <div class="card-block">
            <form id="permissionForm" method="post" action="{{ (@$permission) ? route('permissions.update', $permission->id) : route('permissions.store') }}" novalidate>
                @csrf
                @method((@$permission) ? 'PUT': 'POST')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name" value="{{ (@$permission) ? $permission->name :old('name') }}"/>
                        {{-- @if($errors->has('name'))
                            <span class="messages">{{ $errors->first('name') }}</span>
                        @endif --}}
                        @error('name')
                            <span class="messages">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Slug</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter Your slug" value="{{ (@$permission) ? $permission->slug :old('slug') }}" readonly/>
                        {{-- @if($errors->has('slug'))
                            <span class="messages">{{ $errors->first('slug') }}</span>
                        @endif --}}
                        @error('slug')
                            <span class="messages">{{ $message }}</span>
                        @enderror
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
<script>
    const input = document.getElementById('name');
    const slug = document.getElementById('slug');

    input.addEventListener('input', updateValue);

    function updateValue(e) {
        var t = e.target.value

        var f = t.toLowerCase()
        .replace(/[^\w ]+/g, '')
        .replace(/ +/g, '-');
        slug.value = f;
    }
</script>

@endpush
