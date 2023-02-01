@extends('backend.layouts.master')
@section('stock_item_active', 'active pcoded-trigger')
@section('view_stock_item_active', 'active')
@section('title', 'View stock_item')
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
        <div class="card-header">
            <button type="button" class="btn waves-effect waves-light btn-primary"  data-toggle="modal" data-target="#stockItemModal"><i class="icofont icofont-user-alt-3"></i>{{ __('Add stock item') }}</button>
            @include('backend.pages.stock-item.dealer-create')
            <button type="button" class="btn waves-effect waves-light btn-primary"  data-toggle="modal" data-target="#stockInItemModal"><i class="icofont icofont-user-alt-3"></i>{{ __('Manual stock in item') }}</button>
            @include('backend.pages.stock-item.dealer-create-stock')
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table class="table table-striped table-bordered nowrap responsive">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Item</th>
                            <th>Dealer</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stockItems as $stockItem)
                            <tr>
                                <td data-label="SL">{{ $loop->iteration }}</td>
                                <td data-label="Name">{{ $stockItem->item->name ?? "" }}</td>
                                <td data-label="Name">{{ $stockItem->dealer->name ?? "" }}</td>
                                <td data-label="Image">{{ $stockItem->quantity }}</td>
                                <td data-label="Image">{{ $stockItem->price }}</td>
                                <td data-label="Image">{{ $stockItem->temp_total }}</td>
                                <td data-label="Image">{{ $stockItem->created_at->format('d-M-Y') }}</td>
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
        {{-- <div class="strike">
            <span>Stock Out</span>
        </div>

        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table class="table table-striped table-bordered nowrap responsive">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stockOutItems as $stockItem)
                            <tr>
                                <td data-label="SL">{{ $loop->iteration }}</td>
                                <td data-label="Name">{{ $stockItem->item->name }}</td>
                                <td data-label="Quantity">{{ $stockItem->quantity }}</td>
                                <td data-label="Price">{{ $stockItem->price }}</td>
                                {{-- <td data-label="Action">
                                    <form action="{{route('stock_items.destroy',$stock_item->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a href="{{route('stock_items.edit',$stock_item->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a>
                                        <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td> --}}
                            {{-- </tr>
                        @empty
                            <td colspan="8">No stock_item available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div> --}}
    </div>
</div>
@endsection
