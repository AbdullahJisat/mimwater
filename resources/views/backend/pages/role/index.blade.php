@extends('backend.layouts.master')
@section('role_active', 'active pcoded-trigger')
@section('view_role_active', 'active')
@section('title', 'View role')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            {{-- @isset($url) --}}
            {{-- @can('role-create') --}}
                <a href="{{ route("roles.create") }}" class="btn waves-effect waves-light btn-primary"><i class="icofont icofont-user-alt-3"></i>{{ __('Add role') }}</a>
            {{-- @endisset --}}
            {{-- @endcan --}}
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="roleTbl" class="table table-striped table-bordered nowrap responsive">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr>
                                <td data-label="SL">{{ ++$i }}</td>
                                <td data-label="Name">{{ $role->name }}</td>
                                <td data-label="Action">

                                    <form action="{{route('roles.destroy',$role->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        @can('role-edit')
                                        <a href="{{route('roles.edit',$role->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('role-delete')
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <td colspan="8">No role available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {!! $roles->render() !!}
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $('#roleTbl').DataTable();
</script>
@endpush
