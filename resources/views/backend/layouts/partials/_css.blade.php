<link rel="icon" href="https://colorlib.com/polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="{{ asset('backend/assets/css/waves.min.css') }}" type="text/css" media="all">

<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/feather.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/font-awesome-n.min.css') }}">

<link rel="stylesheet" href="{{ asset('backend/assets/css/chartist.css') }}" type="text/css" media="all">

<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets') }}/css/datatables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets') }}/css/buttons.datatables.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets') }}/css/responsive.bootstrap4.min.css">

<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/widget.css') }}">




<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets') }}/css/themify-icons.css">

<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets') }}/css/icofont.css">

<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets') }}/css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets') }}/css/pages.css">

{{-- <style>
/*responsive*/
@media (max-width: 500px) {
  .table thead {
    display: none;
  }

  .table,
  .table tbody,
  .table tr,
  .table td {
    display: block;
    width: 100%;
  }
  .table tr {
    margin-bottom: 15px;
  }
  .table td {
    padding-left: 50%;
    text-align: left;
    position: relative;
  }
  .table td::before {
    content: attr(data-label);
    position: absolute;
    left: 0;
    width: 50%;
    padding-left: 15px;
    font-size: 15px;
    font-weight: bold;
    text-align: left;
  }
}
</style> --}}

@stack('css')
