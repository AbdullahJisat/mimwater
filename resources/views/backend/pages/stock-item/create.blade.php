<div class="modal fade" id="stockItemModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('stock-items.store') }}" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Dealer Name</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="retailer_id" id="retailer_id">
                                <option value="-1">Select Retailer</option>
                                @foreach ($retailers as $retailer)
                                    <option value="{{ $retailer->id }}">{{ $retailer->name }}</option>
                                @endforeach
                            </select>
                            @error('retailer_id')
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
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                            <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Enter Your quantity" value="{{ old('quantity') }}"/>
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
                                    <input class="form-check-input" type="radio" name="stock" disabled id="stock" value="0"
                                    {{-- onchange="document.getElementById('priceDiv').style.display = 'block'" --}}
                                    > Out
                                </label>
                            </div>
                            @if($errors->has('stock'))
                                <span class="messages">{{ $errors->first('stock') }}</span>
                            @endif
                        </div>
                    </div>
                    {{-- <div id="priceDiv" style="display: none">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="price" id="price" placeholder="Enter Your price" value="{{ old('price') }}"/>
                                @error('price')
                                    <span class="messages">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light ">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
