@extends('backend.layouts.master')
@section('permission_active', 'active pcoded-trigger')
@section('view_permission_active', 'active')
@section('title', 'View permission')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            {{-- @isset($url) --}}
            {{-- @can('permission-create') --}}
                <a href="{{ route("permissions.create") }}" class="btn waves-effect waves-light btn-primary"><i class="icofont icofont-user-alt-3"></i>{{ __('Add permission') }}</a>
            {{-- @endisset --}}
            {{-- @endcan --}}
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="permissionTbl" class="table table-striped table-bordered nowrap responsive">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permissions as $permission)
                            <tr>
                                <td data-label="SL">{{ ++$i }}</td>
                                <td data-label="Name">{{ $permission->name }}</td>
                                <td data-label="Action">

                                    {{-- <form action="{{route('permissions.destroy',$permission->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        @can('permission-edit')
                                        <a href="{{route('permissions.edit',$permission->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('permission-delete')
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                        @endcan
                                    </form> --}}
                                </td>
                            </tr>
                        @empty
                            <td colspan="8">No permission available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {!! $permissions->render() !!}
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $('#permissionTbl').DataTable();
</script>
@endpush
