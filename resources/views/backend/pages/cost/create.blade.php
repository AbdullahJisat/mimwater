<div class="modal fade" id="costModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create cost</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('costs.store') }}" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">cost</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="category_id" id="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="col-sm-2">
                            <a class="btn waves-effect waves-light btn-primary"  data-toggle="modal" href="#categoryModal"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                            </div>
                            @error('category_id')
                                <span class="messages">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">amount</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Your amount" />
                            @error('amount')
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

@include('backend.pages.category.create')
