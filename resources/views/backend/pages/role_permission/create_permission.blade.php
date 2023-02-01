<div class="modal fade" id="permissionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('admin.role.permission_store') }}" novalidate>
                <div class="modal-body">
                    @csrf
                    <div class="form-group row" id="parent">
                        <label class="col-sm-2 col-form-label">Permission Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="parentName" id="parentName"
                                placeholder="Enter bottles quantity" />
                            @error('quantity')
                            <span class="messages">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row tags_add" id="tags_add" style="display: none">
                        <label class="col-sm-2 col-form-label">Permission Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="names" data-role="tagsinput"
                                id="permissionNames">
                            @error('quantity')
                            <span class="messages">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <input style="margin-right: 10px;" type="checkbox" id="haveParent" onclick="if (document.getElementById('parentDiv').style.display == 'none' && document.getElementById('tags_add').style.display == 'none') {
                        document.getElementById('parentDiv').style.display = 'flex';
                        document.getElementById('tags_add').style.display = 'flex';
                        document.getElementById('parent').style.display = 'none';
                        document.getElementById('parentName').value = '';

                    } else {
                        document.getElementById('parentDiv').style.display = 'none';
                        document.getElementById('tags_add').style.display = 'none';
                        document.getElementById('parent').style.display = 'flex';
                        document.getElementById('parent_id').value = '';
                        document.getElementById('permissionNames').value = '';
                    }">

                    <label for="haveParent">
                        Have Parent?
                    </label>
                    <div class="form-group row" id="parentDiv" style="display:none;">
                        <label class="col-sm-2 col-form-label">Parent Permission</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="parent_id" id="parent_id">
                                <option value="">Select Parent</option>
                                @foreach ($permissions as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
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
