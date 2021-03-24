@extends('layouts.admin')
@section('title', __('documents.title'))
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6"><a href="{{ route('documents.index') }}">{{ __('documents.title') }} ({{ $data->total() }})</a></div>
            <div class="col-md-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'documents_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
                <th>{{trans('documents.fields.gcs')}}</th>
                <th>{{trans('documents.fields.account_number')}}</th>
                <th>{{trans('documents.fields.entity_id')}}</th>
                <th>{{trans('documents.fields.entity_name')}}</th>
                <th>{{trans('documents.fields.physical_address')}}</th>
                <th>{{trans('documents.fields.delivery_address')}}</th>
                <th>{{trans('documents.fields.tax_exempt')}}</th>
                <th>{{trans('documents.fields.tax_reference')}}</th>
                <th>{{trans('documents.fields.sales_code')}}</th>
                <th>{{trans('documents.fields.discount_perc')}}</th>
                <th>{{trans('documents.fields.exchange_rate')}}</th>
                <th>{{trans('documents.fields.terms')}}</th>
                <th>{{trans('documents.fields.expire_delivery')}}</th>
                <th>{{trans('documents.fields.freight_method')}}</th>
                <th>{{trans('documents.fields.ship_deliver')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>

        </table>
    </div>
  </div>
<!-- /.box-footer-->
</div>
<form method="post" id="main_form" enctype="multipart/form-data">
@csrf
<input type="hidden" id="action"/>
<input type="hidden" name="_method" id="method">
<input type="hidden" id="id" value=""><input type="hidden" name="company_id" id="company_id" value="{{ session()->get('company_id') }}">
<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Record</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="form-group row">
                <label class="col-md-3">{{__('documents.fields.gcs')}}</label>
                <div class="col-md-9">
                    <input type="text" name="gcs" id="gcs" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('documents.fields.account_number')}}</label>
                <div class="col-md-9">
                    <input type="text" name="account_number" id="account_number" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('documents.fields.entity_id')}}</label>
                <div class="col-md-9">
                    <input type="number" name="entity_id" id="entity_id" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('documents.fields.entity_name')}}</label>
                <div class="col-md-9">
                    <input type="text" name="entity_name" id="entity_name" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('documents.fields.physical_address')}}</label>
                <div class="col-md-9">
                    <textarea name="physical_address" id="physical_address" class="form-control"></textarea>
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('documents.fields.delivery_address')}}</label>
                <div class="col-md-9">
                    <textarea name="delivery_address" id="delivery_address" class="form-control"></textarea>
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('documents.fields.tax_exempt')}}</label>
                <div class="col-md-9">
                    <input type="text" name="tax_exempt" id="tax_exempt" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('documents.fields.tax_reference')}}</label>
                <div class="col-md-9">
                    <input type="text" name="tax_reference" id="tax_reference" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('documents.fields.sales_code')}}</label>
                <div class="col-md-9">
                    <input type="number" name="sales_code" id="sales_code" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('documents.fields.discount_perc')}}</label>
                <div class="col-md-9">
                    <input type="text" name="discount_perc" id="discount_perc" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('documents.fields.exchange_rate')}}</label>
                <div class="col-md-9">
                    <input type="text" name="exchange_rate" id="exchange_rate" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('documents.fields.terms')}}</label>
                <div class="col-md-9">
                    <input type="number" name="terms" id="terms" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('documents.fields.expire_delivery')}}</label>
                <div class="col-md-9">
                    <input type="text" name="expire_delivery" id="expire_delivery" class="form-control date">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('documents.fields.freight_method')}}</label>
                <div class="col-md-9">
                    <input type="text" name="freight_method" id="freight_method" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('documents.fields.ship_deliver')}}</label>
                <div class="col-md-9">
                    <input type="text" name="ship_deliver" id="ship_deliver" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('documents.fields.deleted_at')}}</label>
                <div class="col-md-9">
                    <input type="text" name="deleted_at" id="deleted_at" class="form-control">
                </div>
            </div>

          <div class="form-group" align="right">

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
<script>

$(function () {
    var table = $('#dataTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "/documents/documents/get-data",
    columnDefs: [

    ],
    columns: [
        {data:'gcs', name:'gcs'},
        {data:'account_number', name:'account_number'},
        {data:'entity_id', name:'entity_id'},
        {data:'entity_name', name:'entity_name'},
        {data:'physical_address', name:'physical_address'},
        {data:'delivery_address', name:'delivery_address'},
        {data:'tax_exempt', name:'tax_exempt'},
        {data:'tax_reference', name:'tax_reference'},
        {data:'sales_code', name:'sales_code'},
        {data:'discount_perc', name:'discount_perc'},
        {data:'exchange_rate', name:'exchange_rate'},
        {data:'terms', name:'terms'},
        {data:'expire_delivery', name:'expire_delivery'},
        {data:'freight_method', name:'freight_method'},
        {data:'ship_deliver', name:'ship_deliver'},
		{
        "render": function(d,t,r){
            let $select = $("<select></select>", {
                'class':"form-control dropdown-action",
                'id':r.id,
            });
            let $option='';

            $option = $('<option></option>', {
                "text":'--Select--',
                "value":''
            });
            $select.append($option);
            @if(count(array_intersect(session()->get('grant'), ['SU', 'documents_edit']))==1)
            $option = $('<option></option>', {
                "text":'{{__('global.edit')}}',
                "value":'Edit'
            });
            $select.append($option);
            @endif
            @if(count(array_intersect(session()->get('grant'), ['SU', 'documents_delete']))==1)
            $option = $('<option></option>', {
                "text":'{{__('global.delete')}}',
                "value":'Delete'
            });
            $select.append($option);
            @endif
            return $select.prop("outerHTML");
        }},
    ],
    pageLength: 15,
    lengthMenu: [[10, 15, 25, 50, -1], [10, 15, 25, 50, "All"]]
    });
});

$('#create_record').click(function () {
    $('#main_form')[0].reset();
    $('.modal-title').html(add);
    $('#action').val('Add');
    $('#formModal').modal('show');
});
$('#main_form').on('submit', function (event) {
    event.preventDefault();
    if($('#action').val() === 'Add')
    {
        $('#method').val('');
        $.ajax({
            url: "/documents/documents",
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
                    $('#dataTable').DataTable().ajax.reload(null, false);
                    notice('success', '{{__('global.record_added')}}');
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
            url: "/documents/documents/"+id,
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
                    $('#dataTable').DataTable().ajax.reload(null, false);
                    notice('success', '{{__('global.record_updated')}}');
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
                url:'/documents/documents/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val('Update');
                    $('#id').val(response.data.id);
					$('#company_id').val(response.data.company_id);
					$('#gcs').val(response.data.gcs);
					$('#account_number').val(response.data.account_number);
					$('#entity_id').val(response.data.entity_id);
					$('#entity_name').val(response.data.entity_name);
					$('#physical_address').val(response.data.physical_address);
					$('#delivery_address').val(response.data.delivery_address);
					$('#tax_exempt').val(response.data.tax_exempt);
					$('#tax_reference').val(response.data.tax_reference);
					$('#sales_code').val(response.data.sales_code);
					$('#discount_perc').val(response.data.discount_perc);
					$('#exchange_rate').val(response.data.exchange_rate);
					$('#terms').val(response.data.terms);
					$('#expire_delivery').val(response.data.expire_delivery);
					$('#freight_method').val(response.data.freight_method);
					$('#ship_deliver').val(response.data.ship_deliver);
					$('#deleted_at').val(response.data.deleted_at);

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
                        url: '/documents/documents/' + id,
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
</script>
@endsection
