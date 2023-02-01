@extends('backend.layouts.master')
@section('admin_active', 'active pcoded-trigger')
@section('view_admin_active', 'active')
@section('title', 'View admin')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            {{-- @isset($url) --}}
            <a href="{{ route("admins.create") }}" class="btn waves-effect waves-light btn-primary"><i
                    class="icofont icofont-user-alt-3"></i>{{ __('Add admin') }}</a>
            {{-- @endisset --}}
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="adminTbl" class="table table-striped table-bordered nowrap responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($admins as $admin)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                @if(!empty($admin->roles))
                                @foreach($admin->roles as $role)
                                <label class="badge badge-success">{{ $role->name }}</label>
                                @endforeach
                                @endif
                            </td>
                            <td data-label="Action">
                                <form action="{{route('admins.destroy',$admin->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{route('admins.edit',$admin->id)}}"
                                        class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                    <button type="submit" onclick="return confirm('Are you sure to delete?')"
                                        class="btn waves-effect waves-light btn-success"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <td colspan="8">No admin available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $admins->render() }}
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $('#adminTbl').DataTable();
</script>
@endpush
