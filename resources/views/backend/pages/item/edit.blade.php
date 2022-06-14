@extends('backend.layouts.master')
@section('item_active', 'active pcoded-trigger')
@section('add_item_active', 'active')
@section('title', 'Add item')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('items.index') }}" class="btn waves-effect waves-light btn-primary"><i
                    class="icofont icofont-user-alt-3"></i>{{ __('View Item') }}</a>
        </div>
        <div class="card-block">
            <form id="itemForm" method="post" action="{{ route('items.update', $item->id) }}" novalidate enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name" value="{{ (@$item) ? $item->name : old('name') }}"/>
                        @error('name')
                            <span class="messages">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="image" name="image"/>
                            @if($errors->has('image'))
                                <span class="messages">{{ $errors->first('image') }}</span>
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
