<div class="modal fade" id="dealerDueModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Dealer Due</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('stock-out-items.dealer_due_store') }}" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Dealer Name</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="dealer_id" id="dealer_id">
                                <option value="-1">Select Dealer</option>
                                @foreach ($dealers as $dealer)
                                    <option value="{{ $dealer->id }}">{{ $dealer->name }}</option>
                                @endforeach
                            </select>
                            @error('dealer_id')
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
