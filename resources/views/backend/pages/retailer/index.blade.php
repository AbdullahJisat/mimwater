@extends('backend.layouts.master')
@section('retailer_active', 'active pcoded-trigger')
@section('view_retailer_active', 'active')
@section('title', 'View retailer')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            {{-- @isset($url) --}}
                <a href="{{ route("retailers.create") }}" class="btn waves-effect waves-light btn-primary"><i class="icofont icofont-user-alt-3"></i>{{ __('Add retailer') }}</a>
            {{-- @endisset --}}
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="retailerTbl" class="table table-striped table-bordered nowrap responsive">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th>Shop Name</th>
                            <th>Shop Location</th>
                            <th>Nid</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($retailers as $retailer)
                            <tr>
                                <td data-label="SL">{{ $loop->iteration }}</td>
                                <td data-label="Name">{{ $retailer->name }}</td>
                                <td data-label="Email">{{ $retailer->email }}</td>
                                <td data-label="Username">{{ $retailer->username }}</td>
                                <td data-label="Phone">{{ $retailer->phone }}</td>
                                <td data-label="Location">{{ $retailer->location }}</td>
                                <td data-label="Shop Name">{{ $retailer->shopname }}</td>
                                <td data-label="Shop Location">{{ $retailer->shop_location }}</td>
                                <td data-label="Nid">{{ $retailer->nid }}</td>
                                <td data-label="Password">{{ $retailer->password }}</td>
                                <td data-label="Action">
                                    <form action="{{route('retailers.destroy',$retailer->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('retailers.edit',$retailer->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <td colspan="8">No retailer available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $('#retailerTbl').DataTable();
</script>
@endpush
