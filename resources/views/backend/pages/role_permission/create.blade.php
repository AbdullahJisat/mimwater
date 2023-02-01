@extends('backend.layouts.master')
@section('role_active', 'active pcoded-trigger')
@section('view_role_active', 'active')
@section('title', 'View role')
@push('css')


<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/bootstrap-tagsinput.css') }}" />
<style>
    <style type="text/css">.erp_role_permission_area {
        display: block !important;
    }

    .single_permission {
        margin-bottom: 0px;
    }

    .erp_role_permission_area .single_permission .permission_body>ul>li ul {
        display: grid;
        margin-left: 25px;
        grid-template-columns: repeat(3, 1fr);
        /* grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); */
    }

    .erp_role_permission_area .single_permission .permission_body>ul>li ul li {
        margin-right: 20px;

    }

    .mesonary_role_header {
        column-count: 2;
        column-gap: 30px;
    }

    .single_role_blocks {
        display: inline-block;
        background: #4099ff;
        box-sizing: border-box;
        width: 100%;
        margin: 0 0 20px;
        color: #fff;
    }

    .erp_role_permission_area .single_permission .permission_body>ul>li {
        padding: 15px 25px 12px 25px;
    }

    .erp_role_permission_area .single_permission .permission_header {
        padding: 20px 25px 11px 25px;
        position: relative;
    }

    @media (min-width: 320px) and (max-width: 1199.98px) {
        .mesonary_role_header {
            column-count: 1;
            column-gap: 30px;
        }
    }

    @media (min-width: 320px) and (max-width: 767.98px) {
        .erp_role_permission_area .single_permission .permission_body>ul>li ul {
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 10px
                /* grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); */
        }
    }




    .permission_header {
        position: relative;
    }

    .arrow::after {
        position: absolute;
        content: "\e622";
        top: 50%;
        right: 12px;
        height: auto;
        font-family: 'themify';
        color: #fff;
        font-size: 18px;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        right: 22px;
    }

    .arrow.collapsed::after {
        content: "\e61a";
        color: #fff;
        font-size: 18px;
    }

    .erp_role_permission_area .single_permission .permission_header div {
        position: relative;
        top: -5px;
        position: relative;
        z-index: 999;
    }

    .erp_role_permission_area .single_permission .permission_header div.arrow {
        position: absolute;
        width: 100%;
        z-index: 0;
        left: 0;
        bottom: 0;
        top: 0;
        right: 0;
    }

    .erp_role_permission_area .single_permission .permission_header div.arrow i {
        color: #FFF;
        font-size: 20px;
    }
</style>

@endpush
@section('content')
<div class="col-sm-12">
    <form action="{{ route('admin.role.store') }}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                <h5>New role</h5>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" name="name" class="form-control" id="name">
                        @csrf
                        <strong id="errorrole"></strong>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary" id="saverole">Save</button>
                    </div>

                    <div class="col-sm-2">

                        <button type="button" class="btn waves-effect waves-light btn-primary" data-toggle="modal"
                            data-target="#permissionModal">{{ __('Add Permission') }}</button>
                    </div>
                </div>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    @include('backend.pages.role_permission.permissions')
                </div>
            </div>
        </div>
    </form>
</div>
@include('backend.pages.role_permission.create_permission')

@endsection
@push('script')
<script src="{{ asset('backend/assets/js/jquery2.2.0.min.js') }}"></script>


<script src="{{ asset('backend/assets/js/bootstrap-tagsinput.js') }}"></script>
<script>
    $("#saverole").click(function() {
    var tbody = '';
    if ($('input[name=amount]').val() === '') {
        $('#errorrole').text('Please enter amount');
    } else {
        $.ajax({
            type: 'post',
            url: '{{ route('roles.store') }}',
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
                                        data-name="`+ data.name +`" class="deleterole btn waves-effect waves-light btn-success"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>`;
                $('#roleBody').append(tbody);
            },
        });
        $('#amount').val('');
    }
});

$(".deleterole").on('click', function(){
   console.log($(this).data('id'));
   var roleId = $(this).data('id');
    console.log(roleId);
    if (confirm('Are you sure you want to delete this role?')) {
        $.ajax({
            type: 'post',
            url: 'roles/delete/'+ roleId +'',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': roleId,
            },
            success: function(data) {
                $('.item' + roleId).remove();
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
<script>
    $(".Checkbox-parent input").on('click',function(){
        alert('Check');
    var _parent=$(this);
    var nextli=$(this).parent().next().children().children();

    if(_parent.prop('checked')){
     console.log('Checkbox-parent checked');
     nextli.each(function(){
       $(this).children().prop('checked',true);
     });

  }
  else{
    console.log('Checkbox-parent un checked');
     nextli.each(function(){
       $(this).children().prop('checked',false);
     });

  }
    });

    $(".Checkbox-child input").on('click',function(){

    var ths=$(this);
    var parentinput=ths.closest('div').prev().children();
    var sibblingsli=ths.closest('ul').find('li');

    if(ths.prop('checked')){
        console.log('Checkbox-child checked');
        parentinput.prop('checked',true);
    }
    else{
        console.log('Checkbox-child unchecked');
        var status=true;
        sibblingsli.each(function(){
        console.log('sibb');
        if($(this).children().prop('checked')) status=false;
        });
        if(status) parentinput.prop('checked',false);
    }
    });
</script>

<script>
    $('.permission-checkAll').on('click', function() {

        // $('.module_id_'+$(this).val()).prop('checked', this.checked);
// console.log($(this).val());

        if ($(this).is(":checked")) {
            $('.module_id_' + $(this).val()).each(function() {
            // $('.module_id_1').each(function() {
                $(this).prop('checked', true);
            });
        } else {
            // $('.module_id_1').each(function() {
            $('.module_id_' + $(this).val()).each(function() {
                $(this).prop('checked', false);
            });
        }
    });



    $('.module_link').on('click', function() {

        var module_id = $(this).parents('.single_permission').attr("id");
        var module_link_id = $(this).val();


        if ($(this).is(":checked")) {
            console.log(module_id, module_link_id);
            $(".module_option_" + module_id + '_' + module_link_id).prop('checked', true);
        } else {
            $(".module_option_" + module_id + '_' + module_link_id).prop('checked', false);
        }

        var checked = 0;
        $('.module_id_' + module_id).each(function() {
            if ($(this).is(":checked")) {
                checked++;
            }
        });

        if (checked > 0) {
            $(".main_module_id_" + module_id).prop('checked', true);
        } else {
            $(".main_module_id_" + module_id).prop('checked', false);
        }
    });




    $('.module_link_option').on('click', function() {

        var module_id = $(this).parents('.single_permission').attr("id");
        var module_link = $(this).parents('.module_link_option_div').attr("id");




        // module link check

        var link_checked = 0;

        $('.module_option_' + module_id + '_' + module_link).each(function() {
            if ($(this).is(":checked")) {
                link_checked++;
            }
        });

        if (link_checked > 0) {
            $("#Sub_Module_" + module_link).prop('checked', true);
        } else {
            $("#Sub_Module_" + module_link).prop('checked', false);
        }

        // module check
        var checked = 0;

        $('.module_id_' + module_id).each(function() {
            if ($(this).is(":checked")) {
                checked++;
            }
        });


        if (checked > 0) {
            $(".main_module_id_" + module_id).prop('checked', true);
        } else {
            $(".main_module_id_" + module_id).prop('checked', false);
        }
    });
</script>
@endpush
