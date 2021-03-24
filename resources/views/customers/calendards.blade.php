@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="/vendors/fullcalendar/main.min.css" />
@endsection
@section('content')

<div id="arrow_list_open"><a href="#"><i class="bi bi-caret-right"></i></a></div>
<div class="split-panel">
    <div class="list-panel">
        <div class="title mb-1">
            {{ __('documents_items.title') }}<span style="float: right"><a href="#"><i class="bi bi-caret-left" id="arrow_list_close"></i></a></span>
        </div>
        <form action="{{ url('documents/all') }}" method="get">
            <div class="input-group input-group-sm mb-2">
                <input type="text" class="form-control form-control-sm" name="search" placeholder="{{ __('global.search') }}" aria-label="Search" aria-describedby="basic-addon2" @if(isset($search)) value="{{$search}}" @endif>
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm" type="submit">
                    <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="list-group">
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('all')">{{ __('accounting_lookup.documents.all') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('credit-notes')">{{ __('accounting_lookup.documents.credit_note') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('credit-from-suppliers')">{{ __('accounting_lookup.documents.credit_from_supplier') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('credit-to-suppliers')">{{ __('accounting_lookup.documents.credit_to_supplier') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('debit-notes')">{{ __('accounting_lookup.documents.debit_note') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('goods-delivery-notes')">{{ __('accounting_lookup.documents.goods_delivery_note') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('goods-received-notes')">{{ __('accounting_lookup.documents.goods_received_note') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('purchase-orders')">{{ __('accounting_lookup.documents.purchase_order') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('quotations')">{{ __('accounting_lookup.documents.quotation') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('receipts')">{{ __('accounting_lookup.documents.receipts') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('payment-made')">{{ __('accounting_lookup.documents.payment_made') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('return-debits')">{{ __('accounting_lookup.documents.return_debit') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('sales-orders')">{{ __('accounting_lookup.documents.sales_order') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('supplier-invoices')">{{ __('accounting_lookup.documents.supplier_invoice') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('tax-invoices')">{{ __('accounting_lookup.documents.tax_invoice') }}</button>
        </div>
    </div>

    <div class="content-panel">
        <div class="container pt-3" style="background-color: white;">
            <div id='calendar'></div>
        </div>
    </div>
</div>
<form method="post" id="main_form" enctype="multipart/form-data">
@csrf
<input type="hidden" id="action" value="Add"/>
<input type="hidden" name="_method" id="method">
<input type="hidden" id="id" value="">
<input type="hidden" name="entity_id" id="entity_id" value="">
<input type="hidden" name="gcs" id="gcs" value="">
<input type="hidden" name="creator" id="creator" value="{{ auth()->id() }}">
<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Record</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="form-group row">
                <label class="col-md-3">{{__('calendars.fields.entity_name')}}</label>
                <div class="col-md-9">
                    <input type="text" name="entity_name" id="entity_name" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('calendars.fields.description')}}</label>
                <div class="col-md-9">
                    <input type="text" name="description" id="description" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('calendars.fields.assigned_to')}}</label>
                <div class="col-md-9">
                    <select name="assigned_to" id="assigned_to" class="form-control form-control-sm employee_select"></select>
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('calendars.fields.subject')}}</label>
                <div class="col-md-9">
                    <input type="text" name="subject" id="subject" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('calendars.fields.comment')}}</label>
                <div class="col-md-9">
                    <textarea name="comment" id="comment" class="form-control form-control-sm"></textarea>
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('calendars.fields.status')}}</label>
                <div class="col-md-9">
                    <input type="text" name="status" id="status" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('calendars.fields.start_date')}}</label>
                <div class="col-md-9">
                    <input type="text" name="start_date" id="start_date" class="form-control form-control-sm datetime">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('calendars.fields.end_date')}}</label>
                <div class="col-md-9">
                    <input type="text" name="end_date" id="end_date" class="form-control form-control-sm datetime">
                </div>
            </div>
      </div>
      <div class="modal-footer">
          <input type="submit" class="btn btn-primary btn-sm" value="{{ __('global.save') }}">
      </div>
    </div>
  </div>
</form>
@endsection
@section('scripts')
<script src="/vendors/fullcalendar/main.min.js"></script>
<script>
$(document).ready(function() {
$('.datetime').datetimepicker({
    format: 'YYYY-MM-DD HH:mm',
    locale: 'en',
    sideBySide: true
});
$(function(){
    $('#arrow_list_open').hide();
    //getDetail('all');
});
$('#arrow_list_close').on('click', function(){
    $('.list-panel').hide();
    $('#arrow_list_open').show();
});
$('#arrow_list_open').on('click', function(){
    $('#arrow_list_open').hide();
    $('.list-panel').show();
});
$('.list-group-item').on('click', function(){
    $('.list-group-item').removeClass('active');
})

        // $('#calendar').FullCalendar({
        //     themeSystem: 'bootstrap',
        //     header: {
        //         left: 'prev,next today',
        //         center: 'title',
        //         right: 'month,agendaWeek,agendaDay'
        //     },
        //     defaultDate: '{{date('Y-m-d')}}',
        //     defaultView: 'month',
        //     editable: true,
        //     events: '/customers/calendars/get-data'+string,
        //     selectable:true,
        //     selectHelper: true,
        //     select: function (start, end, allDay) {
        //         var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
        //         var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
        //         $('#start_date').val(start);
        //         $('#end_date').val(end);
        //         $('#formModal').modal('show');
        //     },
        //     eventResize:function (event) {
        //         var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
        //         var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
        //         var id = event.id;
        //         $.ajax({
        //             url: '/customers/calendars/'+id,
        //             type: 'POST',
        //             data: {start_date:start, end_date:end, _method:'PUT'},
        //             success:function () {
        //                 notice('success', '{{trans('global.record_updated')}}');
        //                 $('#calendar').fullCalendar('refetchEvents');
        //             }
        //         });
        //     },
        //     eventDrop:function (event) {
        //         var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
        //         var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
        //         var id = event.id;
        //         $.ajax({
        //             url: '/customers/calendars/'+id,
        //             type: 'POST',
        //             data: {start_date:start, end_date:end, _method:'PUT'},
        //             success:function () {
        //                 notice('success', '{{trans('global.record_updated')}}');
        //                 $('#calendar').fullCalendar('refetchEvents');
        //             }
        //         });
        //     },
        //     eventClick:function (event) {
        //         Swal.fire({
        //             title: '{{trans("global.delete")}}',
        //             text: "{{trans('global.confirm_delete')}}",
        //             icon: 'warning',
        //             showCancelButton: true,
        //             confirmButtonColor: '#3085d6',
        //             cancelButtonColor: '#d33',
        //             confirmButtonText: '{{ __("global.yes") }}'
        //         }).then((result) => {
        //             if (result.value) {
        //                 $.ajax({
        //                     url: '/customers/calendars/' + event.id,
        //                     dataType: 'JSON',
        //                     data: {_method: 'DELETE'},
        //                     method: 'POST',
        //                     success: function (response) {
        //                         if (response.success) {
        //                             notice('success', '{{trans('global.record_deleted')}}');
        //                             $('#calendar').fullCalendar('refetchEvents');
        //                         }
        //                     }
        //                 });
        //             }
        //         });
        //     }
        // });

    });


$('#create_record').click(function () {
    $('#main_form')[0].reset();
    $('.modal-title').html(add);
    $('#action').val('Add');
    $('#formModal').modal('show');
});
let string = '?id={{ isset($data['id'])? $data['id'].'~'.$data['gcs']:'0~C' }}';
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        editable: true,
        events: '/customers/calendars/get-data'+string,
        selectable:true,
        dateClick: function(info) {
            $('#main_form')[0].reset();
            $('.modal-title').html(add);
            $('#action').val('Add');
            $('#start_date').val(info.dateStr+' 09:00:00');
            $('#end_date').val(info.dateStr+' 10:00:00');
            $('#formModal').modal('show');

        },
        eventClick:function (info) {
            // show
            alert(alert(JSON.stringify(info, null, 4)));
        }

    });
    calendar.render();
});

$('#main_form').on('submit', function (event) {
    event.preventDefault();
    if($('#action').val() === 'Add')
    {
        $('#method').val('');
        $.ajax({
            url: "/customers/calendars",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            success: function (response) {
                if(response.success){
                    $('#main_form')[0].reset();
                    $('#formModal').modal('hide');
                    notice('success', '{{__('global.record_added')}}');
                    $('#calendar').fullCalendar('refetchEvents');
                }else{
                    let err='<ul class="text-left">';
                    for(let i=0; i<response.errors.length; i++)
                    {
                        err += "<li>"+response.errors[i]+"</li>";
                    }
                    err +="</ul>";
                    notice('error', '{{__('global.error_add')}}', err);
                }
            }
        });
    }
    if($('#action').val() === 'Update')
    {
        let id = $('#id').val();
        $('#method').val('PUT');
        $.ajax({
            url: "/customers/calendars/"+id,
            method:'POST',
            data: new FormData(this),
            processData:false,
            contentType: false,
            cache: false,
            dataType: 'JSON',
            success: function(response)
            {
                if(response == 'success'){
                    $('#formModal').modal('hide');
                    notice('success', '{{__('global.record_updated')}}');
                    calendar.refetchEvents()
                }else{
                    let err='<ul class="text-left">';
                    for(let i=0; i<response.errors.length; i++)
                    {
                        err += "<li>"+response.errors[i]+"</li>";
                    }
                    err +="</ul>";
                    notice('error', '{{__('global.error_update')}}', err);
                }
            }
        });
    }
});
$(document).on('change', '.dropdown-action', function(){
    let id = $(this).attr('id');
    let val = $('#' + id).val();

    switch(val)
    {
        case 'Edit':
        $.ajax({
                url:'/customers/calendars/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val('Update');
                    $('#id').val(response.data.id);
					$('#company_id').val(response.data.company_id);
					$('#entity_id').val(response.data.entity_id);
					$('#entity_name').val(response.data.entity_name);
					$('#gcs').val(response.data.gcs);
					$('#description').val(response.data.description);
					$('#creator').val(response.data.creator);
					$('#assigned_to').val(response.data.assigned_to);
					$('#subject').val(response.data.subject);
					$('#comment').val(response.data.comment);
					$('#status').val(response.data.status);
					$('#start_date').val(response.data.start_date);
					$('#end_date').val(response.data.end_date);

                }
            });
            $('#formModal').modal('show');
            break;

        case 'Delete':
            Swal.fire({
                position: 'top',
                title: '{{__('global.delete')}}',
                text: "{{__('global.confirm_delete')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __("global.yes") }}'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/customers/calendars/' + id,
                        dataType: 'JSON',
                        data: {_method: 'DELETE', _token:'{{ csrf_token() }}'},
                        method: 'POST',
                        success: function (response) {
                            if (response.success) {
                                notice('success', '{{__('global.record_deleted')}}');
                                $('#dataTable').DataTable().ajax.reload(null, false);
                            }
                        }
                    });
                }
            });
            break;

    }
    $('#'+id).val('');
});
$('.employee_select').select2({
    dropdownParent: '#formModal',
    ajax: {
        url: '/search/employees',
        method: 'POST',
        data: function (params) {
            var query = {
                search: params.term,
            };
            // Query parameters will be ?search=[term]&type=public
            return query;
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
    }
});
</script>
@endsection
