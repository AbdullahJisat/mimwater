@extends('backend.layouts.master')
@section('stock_item_active', 'active pcoded-trigger')
@section('view_stock_item_active', 'active')
@section('title', 'View stock_item')
@push('css')
@endpush
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn waves-effect waves-light btn-primary"  data-toggle="modal" data-target="#stockOutItemModal"><i class="icofont icofont-user-alt-3"></i>{{ __('Add stock Out Item') }}</button>
            @include('backend.pages.stock-out-item.dealer-create')
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table class="table table-striped table-bordered nowrap responsive">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Item</th>
                            <th>Dealer Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stockOutItems as $stockOutItem)
                            <tr>
                                <td data-label="SL">{{ $loop->iteration }}</td>
                                <td data-label="Name">{{ $stockOutItem->item->name ?? "" }}</td>
                                <td data-label="Name">{{ $stockOutItem->dealer->name ?? "" }}</td>
                                <td data-label="Quantity">{{ $stockOutItem->quantity ?? "" }}</td>
                                <td data-label="Price">{{ $stockOutItem->price ?? "" }}</td>
                                <td data-label="Price">{{ $stockOutItem->created_at->format('d-M-Y') ?? "" }}</td>
                                {{-- <td data-label="Action">
                                    <form action="{{route('stock_items.destroy',$stock_item->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('stock_items.edit',$stock_item->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td> --}}
                            </tr>
                        @empty
                            <td colspan="8">No stock_item available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
$('#item_id').change(function(){
    var itemId = $(this).val();
    console.log(itemId);
    var userId = $('#dealer_id').find(":selected").val();
    console.log(userId);
    var c = $('#dealer_id :selected').val();
    console.log(c);
    $.ajax({
        url:`stock-item-quantity/`+itemId+`/`+userId+``,
        method:"get",
        // data:{itemId:itemId, userId:userId},
        success:function(data){
            $("#preQuantity").html(data.quantity);
        }
    });
});
$('#dealer_id').change(function(){
    var userId = $(this).val();
    console.log(userId);
    var itemId = $('#item_id').find(":selected").val();
    console.log(itemId);
    var c = $('#item_id :selected').val();
    console.log(c);
    $.ajax({
        url:`retailer-stock-item-quantity/`+itemId+`/`+userId+``,
        method:"get",
        // data:{itemId:itemId, userId:userId},
        success:function(data){
            $("#preQuantity").html(data.quantity);
        }
    });
});
</script>
@endpush
