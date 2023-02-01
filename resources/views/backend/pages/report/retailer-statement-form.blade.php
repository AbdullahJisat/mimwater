@extends('backend.layouts.master')
@section('retailer_active', 'active pcoded-trigger')
@section('add_retailer_active', 'active')
@section('title', 'Add retailer')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-block">
            <form action="{{ route('statement.index_retailer') }}" method="get">
                {{-- @csrf --}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">retailer Name</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="retailer_id" id="retailer_id">
                            <option value="-1">Select retailer</option>
                            @foreach (allRetailer() as $retailer)
                            <option value="{{ $retailer->id }}">{{ $retailer->name }}</option>
                            @endforeach
                        </select>
                        @error('retailer_id')
                        <span class="messages">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">From Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="start" id="">
                        @error('start')
                        <span class="messages">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">To Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="end" id="">
                        @error('end')
                        <span class="messages">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Search" class="btn btn-primary" id="">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
