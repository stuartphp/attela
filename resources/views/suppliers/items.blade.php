@extends('layouts.admin')
@section('title', __('global.menu.suppliers.title'))
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('global.menu.suppliers.title') }} / <a href="{{ url('suppliers/items') }}">{{ __('supplier_items.title') }}</a></div>
            <div class="col-md-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'supplier_items_create']))==1)
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
               <th>{{__('supplier_items.fields.supplier_id')}}</th><th>{{__('supplier_items.fields.inventory_item_id')}}</th><th>{{__('supplier_items.fields.item_code')}}</th>
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
<input type="hidden" id="id" value="">
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
                <label class="col-md-3">{{__('supplier_items.fields.supplier_id')}}</label>
                <div class="col-md-9">
                    <input type="number" name="supplier_id" id="supplier_id" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('supplier_items.fields.inventory_item_id')}}</label>
                <div class="col-md-9">
                    <input type="number" name="inventory_item_id" id="inventory_item_id" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('supplier_items.fields.item_code')}}</label>
                <div class="col-md-9">
                    <input type="text" name="item_code" id="item_code" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('supplier_items.fields.description')}}</label>
                <div class="col-md-9">
                    <input type="text" name="description" id="description" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('supplier_items.fields.unit')}}</label>
                <div class="col-md-9">
                    <input type="text" name="unit" id="unit" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('supplier_items.fields.currency')}}</label>
                <div class="col-md-9">
                    <input type="text" name="currency" id="currency" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('supplier_items.fields.tax_code')}}</label>
                <div class="col-md-9">
                    <input type="text" name="tax_code" id="tax_code" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('supplier_items.fields.price_excl')}}</label>
                <div class="col-md-9">
                    <input type="text" name="price_excl" id="price_excl" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('supplier_items.fields.price_incl')}}</label>
                <div class="col-md-9">
                    <input type="text" name="price_incl" id="price_incl" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('supplier_items.fields.ledger_account')}}</label>
                <div class="col-md-9">
                    <input type="text" name="ledger_account" id="ledger_account" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('supplier_items.fields.min_order_quantity')}}</label>
                <div class="col-md-9">
                    <input type="number" name="min_order_quantity" id="min_order_quantity" class="form-control">
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
    ajax: "/suppliers/items/get-data",
    columnDefs: [

    ],
    columns: [
        {data:'supplier_id', name:'supplier_id'},
		{data:'inventory_item_id', name:'inventory_item_id'},
		{data:'item_code', name:'item_code'},
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
            @if(count(array_intersect(session()->get('grant'), ['SU', 'supplier_items_edit']))==1)
            $option = $('<option></option>', {
                "text":'{{__('global.edit')}}',
                "value":'Edit'
            });
            $select.append($option);
            @endif
            @if(count(array_intersect(session()->get('grant'), ['SU', 'supplier_items_delete']))==1)
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
            url: "/suppliers/items",
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
            url: "/suppliers/items/"+id,
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
                url:'/suppliers/items/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val('Update');
                    $('#id').val(response.data.id);
					$('#supplier_id').val(response.data.supplier_id);
					$('#inventory_item_id').val(response.data.inventory_item_id);
					$('#item_code').val(response.data.item_code);
					$('#description').val(response.data.description);
					$('#unit').val(response.data.unit);
					$('#currency').val(response.data.currency);
					$('#tax_code').val(response.data.tax_code);
					$('#price_excl').val(response.data.price_excl);
					$('#price_incl').val(response.data.price_incl);
					$('#ledger_account').val(response.data.ledger_account);
					$('#min_order_quantity').val(response.data.min_order_quantity);

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
                        url: '/suppliers/items/' + id,
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
