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
                <form method="post" action="{{ url('admin/update/'.$due->id.'/dealer-due') }}" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Dealer Name</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="dealer_id" id="dealer_id">
                                <option value="-1">Select Dealer</option>
                                @foreach ($dealers as $dealer)
                                    <option value="{{ $dealer->id }}" {{ $due->dealer_id == $dealer->id ? 'selected' : '' }}>{{ $dealer->name }}</option>
                                @endforeach
                            </select>
                            @error('dealer_id')
                                <span class="messages">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Previous Due</label>
                        <div class="col-sm-10">
                            <label for="" id="preDue"></label>
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Due</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="due" id="due" placeholder="Enter Your due" value="{{ $due->due }}"/>
                            @error('due')
                                <span class="messages">{{ $message }}</span>
                            @enderror
                        </div>
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
