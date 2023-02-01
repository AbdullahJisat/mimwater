@extends('backend.layouts.master')
@section('loan_active', 'active pcoded-trigger')
@section('view_loan_active', 'active')
@section('title', 'View loan')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5>New Loan</h5>
            <div class="row">
                <div class="col-sm-8">
                    <input type="text" name="amount" class="form-control" id="amount">
                    @csrf
                    <strong id="errorLoan"></strong>
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary" id="saveLoan">Save</button>
                </div>
            </div>
        </div>
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="loanBody">
                        @forelse ($loans as $loan)
                            <tr class="item{{$loan->id}}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $loan->amount }}</td>
                                <td>{{$loan->created_at->format('Y-m-d')}}</td>
                                <td>
                                    {{-- <form action="{{route('loans.destroy',$loan->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf --}}
                                        {{-- <a href="{{route('loans.edit',$loan->id)}}" class="btn waves-effect waves-light btn-primary"><i class="fas fa-edit"></i></a> --}}
                                        <button data-id="{{$loan->id}}" id=""
                                            data-name="{{$loan->amount}}" class="deleteLoan btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                    {{-- </form> --}}
                                </td>
                            </tr>
                        @empty
                            <td colspan="8">No loan available</td>
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
$("#saveLoan").click(function() {
    var tbody = '';
    if ($('input[name=amount]').val() === '') {
        $('#errorLoan').text('Please enter amount');
    } else {
        $.ajax({
            type: 'post',
            url: '{{ route('loans.store') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'amount': $('input[name=amount]').val()
            },
            success: function(data) {
                console.log(data);
                tbody += `<tr class="item`+ data.id +`">
                                <td>`+ data.id +`</td>
                                <td>`+ data.amount +`</td>
                                <td>`+ formatDate(data.created_at) +`</td>
                                <td>
                                    <button data-id="`+ data.id +`"
                                        data-name="`+ data.name +`" class="deleteLoan btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>`;
                $('#loanBody').append(tbody);
            },
        });
        $('#amount').val('');
    }
});

$(".deleteLoan").on('click', function(){
   console.log($(this).data('id'));
   var loanId = $(this).data('id');
    console.log(loanId);
    if (confirm('Are you sure you want to delete this loan?')) {
        $.ajax({
            type: 'post',
            url: 'loans/delete/'+ loanId +'',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': loanId,
            },
            success: function(data) {
                $('.item' + loanId).remove();
            }
        });
    } else {
        return false;
    }
});

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}

// console.log(formatDate('Sun May 11,2014'));
</script>
@endpush
