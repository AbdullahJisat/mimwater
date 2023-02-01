@extends('backend.layouts.master')
@section('role_active', 'active pcoded-trigger')
@section('view_role_active', 'active')
@section('title', 'View role')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>New role</h5>
            <div class="row">
                <div class="col-sm-6">
                    <select name="search_role" id="search_role" class="form-control">
                        <option value="">Select Role</option>
                        @forelse ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @empty
                        <option value="">No role available</option>
                        @endforelse
                    </select>
                    @csrf
                    <strong id="errorrole"></strong>
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary" id="searchRole">Search</button>
                </div>
                <div class="col-sm-2">

                    <a href="{{ route('admin.role.create') }}" class="btn waves-effect waves-light btn-primary">{{ __('Add Role') }}</a>
                </div>
            </div>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="rolePermissionTbl" style="display:none" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="roleBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('backend/assets/js/jquery2.2.0.min.js') }}"></script>
<script>
    $("#searchRole").click(function() {
    $('#rolePermissionTbl').css('display', 'table')
    var tbody = '';
    var roleId = $('#search_role').val();
    console.log(roleId);
    if (roleId === '') {
        $('#errorrole').text('Please select role');
    } else {
        $.ajax({
            type: 'post',
            url: `role/get-permissions-by-role-id/${roleId}`,
            data: {
                '_token': $('input[name=_token]').val(),
                'roleId': roleId
            },
            success: function(data) {
                console.log(data);
                data.permissions.forEach(element => {
                    tbody += `<tr class="item`+ element.id +`">
                                    <td>`+ element.id +`</td>
                                    <td>`+ element.name +`</td>
                                    <td>
                                        <button data-id="`+ element.id +`"
                                            data-name="`+ element.name +`" class="deleterole btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>`;
            });
                $('#roleBody').append(tbody);
            },
        });
    }
});
</script>
@endpush
