@extends('backend.layouts.master')
@section('dealer_active', 'active pcoded-trigger')
@section('add_dealer_active', 'active')
@section('title', 'Add Dealer')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-block">
            <form action="{{ route('statement.index') }}" method="get">
                {{-- @csrf --}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Dealer Name</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="dealer_id" id="dealer_id">
                            <option value="-1">Select Dealer</option>
                            @foreach (allDealer() as $dealer)
                            <option value="{{ $dealer->id }}">{{ $dealer->name }}</option>
                            @endforeach
                        </select>
                        @error('dealer_id')
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
