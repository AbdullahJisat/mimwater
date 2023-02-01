@extends('backend.layouts.master')
@section('statement_active', 'active pcoded-trigger')
@section('view_statement_active', 'active')
@section('title', 'View statement')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            {{-- <a href="{{ route('statements.create') }}" class="btn waves-effect waves-light btn-primary"><i class="icofont icofont-user-alt-3"></i>{{ __('Add statement') }}</a> --}}
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Date</th>
                            <th>Delivery Quantity</th>
                            <th>Stock Out</th>
                            <th>Total Stock</th>
                            <th>Rate</th>
                            <th>Bill</th>
                            <th>Payment</th>
                            <th>Payment</th>
                            <th>Dues</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <td>&nbsp;</td>
                        <td>quntity : </td>
                        <td>out: </td>
                        <td>stock: </td>
                        <td>&nbsp;</td>
                        <td>bill:</td>
                        <td>payment:</td>
                        <td>dues</td>
                    </tfoot>
                </table>
                <div>
                    <p>discount</p>
                    <p>total</p>
                </div>
                <div>
                    <p>In word</p>
                    <p>total</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
