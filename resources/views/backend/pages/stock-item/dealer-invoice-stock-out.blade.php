
@extends('backend.layouts.master')
@section('stock_item_active', 'active pcoded-trigger')
@section('view_stock_item_active', 'active')
@section('title', 'Dealer Invoice')
@push('css')
<style>
    @media print
    {
        .button
        {
            display: none;
        }
    }
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    }
</style>
@endpush
@section('content')
<div class="col-sm-12">
    <div class="invoice-box">
        <form action="{{ route('invoices.dealer_store_out', $item->id) }}" method="post">
            @csrf
            <input type="button" value="Print Document" onclick="window.print();" class="button">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="{{ asset('frontend/image/meem-logoo.png') }}"
                                        style="width: 100%; max-width: 70px" />
                                </td>

                                <td>
                                    Invoice #: <input type="text" name="invoice_no"><br /> Created: <script
                                        type="text/JavaScript">
                                        const currentDate = new Date();
                                        // weekday: 'long',
                                        const options = { year: 'numeric', month: 'short', day: 'numeric' };
                                        document.write(currentDate.toLocaleDateString('en-us', options));

                                        </script><br /> Due: February 1, 2015
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    Meem Water.<br /> Meem Road<br /> Chattogram, Chattogram
                                </td>

                                <td>
                                    <input type="hidden" name="dealer_id" value="{{ $item->dealer->id }}">
                                    {{ $item->dealer->name }}.<br /> {{ $item->dealer->phone }}<br /> {{
                                    $item->dealer->email }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="heading">
                    <td>Payment Method</td>
                    <td>
                        <select name="payment_type" id="" style="width: 33% !important;float: right;" class="form-control">
                            <option value="">Select Payment</option>
                            <option value="1">Cash</option>
                            <option value="2">Check</option>
                            <option value="3">Bkash Ceo</option>
                            <option value="4">Bkash Office</option>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td>
                        @error('payment_type')
                            <strong style="color: red">{{ $message }}</strong>
                        @enderror
                    </td>
                </tr>

                {{-- <tr class="details">
                    <td>Check</td>

                    <td>1000</td>
                </tr> --}}

                {{-- <tr class="heading">
                    <td>Item</td>

                    <td>Price</td>
                </tr>

                <tr class="item last">
                    <td><input type="hidden" value="{{ $item->item->id }}" name="item_id">{{ $item->item->name ?? "" }}
                    </td>

                    <td>${{ $item->price ?? 0 }}</td>
                </tr> --}}


                <tr class="total">
                    <td></td>

                    <td>Due: ${{ $due ?? 0 }} <input type="hidden" name="totalDue" value="{{ $due ?? 0 }}"></td>
                </tr>



                {{-- <tr class="item">
                    <td>Domain name (1 year)</td>

                    <td>$10.00</td>
                </tr> --}}

                @php
                if($dueCheck == null || $dueCheck->due == 0){
                $total = $item->price + 0;
                }else{
                $total = $item->price + $dueCheck->due;
                }
                @endphp

                <tr class="total">
                    <td></td>

                    <td><input type="hidden" name="amount" id="amount" value="{{ $item->price }}"></td>
                </tr>
                <tr class="total">
                    <td></td>
                    <td>
                        {{-- <input type="text" select name="payment_status" id="" onchange="dueAmount(this.value)">
                        <option value="1">success</option>
                        <option value="2">failed</option>
                        <option value="3">due</option>
                        <option value="4">partial due</option>
                        </select> --}}
                    </td>
                </tr>
                <tr class="total">
                    <td>Enter Amount</td>
                    <td>
                        {{-- id="due" style="display: none" --}}
                        <input type="text" style="width: 33% !important;float: right;" class="form-control" name="due" id="afterAmount">
                    </td>
                </tr>
                <tr class="total">
                    <td>Enter Discount</td>
                    <td>
                        {{-- id="due" style="display: none" --}}
                        <input type="text" style="width: 33% !important;float: right;" class="form-control" name="discount" value="0" onfocus="this.value=''">
                    </td>
                </tr>
            </table>
            <hr>
            <div style="display: flex;justify-content: space-between;">
                <button type="submit" name="action" value="cancel" id="cancel" class="btn btn-primary button">Cancel</button>
                <button type="submit" name="action" value="pay" class="btn btn-primary button">Pay</button>
            </div>
        </form>
    </div>

    {{-- <script>
        window.addEventListener("beforeunload", function () {
            return "You have attempted to leave this page. Are you sure?";
        });
    </script> --}}
    {{-- <script language="JavaScript">
        var r = confirm("You have attempted to leave this page. Are you sure?");
            window.onbeforeunload = confirmExit;
            function confirmExit() {
                if (r == true) {
                    alert("You pressed OK!");
                    document.getElementById("cancel").addEventListener("click");
                } else {
                    alert("You canceled!");
                }
            }
    </script> --}}

    {{-- <script>
        function dueAmount(val) {
            alert(val);
            if(val == 3){
                document.getElementById('due').style.display = 'block';
                var total = document.getElementById('total').value;
                alert(total);
                var amount = document.getElementById('amount').value;
                alert(amount);
                document.getElementById('afterAmount').value = total - amount;
            }
        }


        // window.onbeforeunload = confirmExit();
        // function confirmExit() {
        //     return "You have attempted to leave this page. Are you sure?";
        // }

        // $(window).bind('beforeunload', function() {
        //     $("#id-of-submit-button").click();
        // });
    </script> --}}
</div>
@endsection
