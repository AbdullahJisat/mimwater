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
                <form method="post" action="{{ url('admin/update/'.$stockItem->id.'/dealer-stock-items') }}" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Dealer Name</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="dealer_id" id="dealer_id">
                                <option value="-1">Select Dealer</option>
                                @foreach ($dealers as $dealer)
                                    <option value="{{ $dealer->id }}" {{ $stockItem->dealer_id == $dealer->id ? 'selected' : '' }}>{{ $dealer->name }}</option>
                                @endforeach
                            </select>
                            @error('dealer_id')
                                <span class="messages">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="item_id" id="item_id">
                                <option value="-1">Select Item</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}" {{ $stockItem->item_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('item_id')
                                <span class="messages">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Enter Your quantity" value="{{ $stockItem->quantity }}"/>
                            @error('quantity')
                                <span class="messages">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Stock</label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" checked type="radio" name="stock" id="stock" value="1" onchange="document.getElementById('priceDiv').style.display = 'none'"> In
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="stock" id="stock" value="0" disabled
                                    {{-- onchange="document.getElementById('priceDiv').style.display = 'block'" --}}
                                    > Out
                                </label>
                            </div>
                            @if($errors->has('stock'))
                                <span class="messages">{{ $errors->first('stock') }}</span>
                            @endif
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
