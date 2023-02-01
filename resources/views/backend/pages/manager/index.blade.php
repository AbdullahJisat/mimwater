@extends('backend.layouts.master')
@section('manager_active', 'active pcoded-trigger')
@section('view_manager_active', 'active')
@section('title', 'View manager')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            {{-- @isset($url) --}}
            <a href="{{ route("managers.create") }}" class="btn waves-effect waves-light btn-primary"><i
                    class="icofont icofont-user-alt-3"></i>{{ __('Add manager') }}</a>
            {{-- @endisset --}}
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="managerTbl" class="table table-striped table-bordered nowrap responsive">
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
                        @forelse ($managers as $manager)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $manager->name }}</td>
                            <td>{{ $manager->email }}</td>
                            <td data-label="Action">
                                <form action="{{route('managers.destroy',$manager->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{route('managers.edit',$manager->id)}}"
                                        class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                    <button type="submit" onclick="return confirm('Are you sure to delete?')"
                                        class="btn waves-effect waves-light btn-success"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <td colspan="8">No manager available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $managers->render() }}
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $('#managerTbl').DataTable();
</script>
@endpush
