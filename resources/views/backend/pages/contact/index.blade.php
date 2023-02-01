@extends('backend.layouts.master')
@section('admin_active', 'active pcoded-trigger')
@section('contact_active', 'active pcoded-trigger')
@section('view_contact_active', 'active')
@section('title', 'View contact')
@push('css')
<style>
    .strike {
        display: block;
        text-align: center;
        overflow: hidden;
        white-space: nowrap;
        margin-bottom: 2rem;
    }

    .strike > span {
        position: relative;
        display: inline-block;
        font-size: larger;
        font-weight: 700;
    }

    .strike > span:before,
    .strike > span:after {
        content: "";
        position: absolute;
        top: 50%;
        width: 9999px;
        height: 1px;
        background: rgb(13, 13, 13);
    }

    .strike > span:before {
        right: 100%;
        margin-right: 15px;
    }

    .strike > span:after {
        left: 100%;
        margin-left: 15px;
    }
</style>
@endpush
@section('content')
<div class="col-sm-12">
    <div class="card">
        {{-- <div class="card-header">
            <a href="{{ route('contacts.create') }}" class="btn waves-effect waves-light btn-primary"><i class="icofont icofont-user-alt-3"></i>{{ __('Add contact') }}</a>
        </div> --}}
        <div class="strike">
            <span>Unread</span>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($unreadMessages as $message)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $message->name ?? "" }}</td>
                                <td>{{ $message->email ?? "" }}</td>
                                <td><a href="{{ route('contact_read', $message->id) }}" style="text-decoration: none !important;color: black;font: caption;"><strong>{{ $message->message ?? "" }}</strong></a></td>
                                <td>
                                    <form action="{{route('contacts.destroy',$message->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('contacts.edit',$message->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <td colspan="8">No contact available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="strike">
            <span>Read</span>
        </div>

        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($readMessages as $message)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $message->name ?? "" }}</td>
                                <td>{{ $message->email ?? "" }}</td>
                                <td><strong>{{ $message->message ?? "" }}</strong></td>
                                <td>
                                    <form action="{{route('contacts.destroy',$message->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('contacts.edit',$message->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <td colspan="8">No contact available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
