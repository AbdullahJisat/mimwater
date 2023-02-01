@extends('backend.layouts.master')
@section('due_active', 'active pcoded-trigger')
@section('view_due_active', 'active')
@section('title', 'View due')
@push('css')
@endpush
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <button style="float: left" type="button" class="btn waves-effect waves-light btn-primary"  data-toggle="modal" data-target="#dealerDueModal"><i class="icofont icofont-user-alt-3"></i>{{ __('Add due') }}</button>
            @include('backend.pages.stock-out-item.dealer_due_create')
            <form style="float: right" action="{{ route('show_dealer_dues_by_date') }}" method="get" style="display: inline-flex">
                {{-- @csrf --}}
                <div class="row input-daterange">
                    <div class="col-md-4">
                        <input type="date" class="form-control" value="{{ old('start') }}" name="start" id="">
                        @error('start')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="end" value="{{ old('end') }}" class="form-control" id="">
                        @error('end')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <input type="submit" value="Search" class="btn btn-primary" id="">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table class="table table-striped table-bordered nowrap responsive">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Dealer Name</th>
                            <th>Due</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dues as $due)
                        @if ($due->due != 0)
                        <tr>
                            <td data-label="SL">{{ $loop->iteration }}</td>
                            <td data-label="Name">{{ $due->dealer->name ?? "" }}</td>
                            <td data-label="Quantity">{{ $due->due }}</td>
                            <td data-label="Quantity">{{ $due->created_at->format('Y-m-d') }}</td>
                            <td data-label="Action">
                                {{-- <form action="{{route('dues.destroy',$due->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf --}}
                                    <a href="{{url('admin/edit/'.$due->id.'/dealer-due')}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                    {{-- <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                </form> --}}
                            </td>
                        </tr>
                        @endif
                        @empty
                            <td colspan="8">No due available</td>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <td colspan="2">Total</td>
                        <td>{{ $duesTotal }}</td>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
$('#dealer_id').change(function(){
    // alert('ff');
    var dealerId = $(this).val();
    // alert(dealerId);
    $.ajax({
        url:`previous-dealer-dues/`+dealerId,
        method:"get",
        success:function(data){
            $("#preDue").html(data);
        }
    });
});
</script>
@endpush
