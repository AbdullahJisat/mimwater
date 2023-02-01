<div class="modal fade" id="retailerDueModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create retailer Due</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('stock-out-items.retailer_due_store') }}" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">retailer Name</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="retailer_id" id="retailer_id">
                                <option value="-1">Select retailer</option>
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
                        <label class="col-sm-2 col-form-label">Previous Due</label>
                        <div class="col-sm-10">
                            <label for="" id="preDue"></label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Due</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="due" id="due" placeholder="Enter Your due" value="{{ old('due') }}"/>
                            @error('due')
                                <span class="messages">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light ">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
