@extends('layouts.iframe')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6"><a href="{{ route('goods-received-notes.index') }}">{{ __('accounting_lookup.documents.goods_received_note') }} ({{ $data->total() }})</a></div>
            <div class="col-md-6 text-right">
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('/documents/goods-received-notes') }}" method="get">
                    <div class="input-group">
                    <input type="text" class="form-control form-control-sm" name="search" placeholder="{{ __('global.search') }}" aria-label="Search" aria-describedby="basic-addon2" @if(isset($keyword)) value="{{$keyword}}" @endif>
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" type="submit">
                        <i class="bi bi-search"></i>
                        </button>
                    </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
                <th class="col-1">{{trans('document_types.fields.action_date')}}</th>
                <th class="col-1">{{trans('documents.fields.account_number')}}</th>
                <th class="col-5">{{trans('documents.fields.entity_name')}}</th>
                <th class="col-1">{{trans('document_types.fields.document_number')}}</th>
                <th class="col-1">{{trans('document_types.fields.document_reference')}}</th>
                <th class="col-1">{{trans('document_types.fields.reference_number')}}</th>
                <th class="col-1 text-end pe-3">{{trans('document_types.fields.total_amount')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($data as $item)
                <tr>
                    <td>{{ $item->action_date }}</td>
                    <td class="">{{ $item->account_number }}</td>
                    <td>{{ $item->entity_name }}</td>
                    <td>{{ $item->document_number }}</td>
                    <td class="">{{ $item->document_reference }}</td>
                    <td class="">{{ $item->reference_number }}</td>
                    <td class="text-end pe-3 {{ ($item->total_due <0.01)? 'text-green': 'text-red' }} ">
                        {{ number_format($item->total_amount,2) }}
                    </td>
                    <td><select class="action form-select" id="{{ $item->id }}">
                        <option value="">{{ __('global.select') }}</option>
                        @if($item->is_paid==1)
                        <option value="Credit">{{ __('global.credit') }}</option>
                        @endif
                        @if($item->is_locked<1)
                        <option value="Edit">{{ __('global.edit') }}</option>
                        <option value="Lock">{{ __('global.lock') }}</option>
                        @endif
                        <option value="PDF">{{ __('global.pdf') }}</option>
                        <option value="View">{{ __('global.view') }}</option>
                        </select></td>
                </tr>
              @endforeach
          </tbody>
        </table>
    </div>
  </div>
  <div class="card-footer">{{ $data->render() }}</div>
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
                <label class="col-md-3">{{__('documents.fields.entity_name')}}</label>
                <div class="col-md-9">
                    <select name="entity_id" id="entity_id" class="form-control form-control-sm"></select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3">{{__('document_types.fields.document_reference')}}</label>
                <div class="col-md-9">
                    <input type="text" name="document_reference" id="document_reference" class="form-control form-control-sm">
                </div>
            </div>
      </div>
      <div class="modal-footer">
          <input type="submit" class="btn btn-primary btn-sm" value="{{ __('global.save') }}">
      </div>
    </div>
  </div>
</div>
</form>
<!-- Modal -->
<div class="modal fade" id="flowModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ __('global.document_flow') }}</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
        <div class="modal-body" id="flowBody">

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')

<script>
function flowLoad(i)
{
    $.ajax({
        url:'/documents/flow/'+i,
        dataType:'JSON',
        method: 'POST',
        success: function (response) {
            let html='<table class="table"><tr><th>{{ __('document_types.fields.action_date') }}</th><th>{{ __('document_types.fields.document_number') }}</th><th>{{ __('document_types.fields.total_amount') }}</th></tr>';
            for(var i=0; i<response.length; i++){
                html += '<tr><td>'+response[i].action_date+'</td><td>'+response[i].document_number+'</td><td class="text-right">'+response[i].total_amount.toFixed(2)+'</td></tr>';
            }
            html +='</table>';
            $('#flowBody').html(html);
        }
    });
    $('#flowModal').modal('show');
}


$('#create_record').click(function () {
    $('#main_form')[0].reset();
    $('.modal-title').html(add);
    $('#method').val('');
        $('#main_form').attr('action',"/documents/tax-invoices");
    $('#action').val(add);
    $('#formModal').modal('show');
});

$(document).on('change', '.action', function(){
    let id = $(this).attr('id');
    let val = $('#' + id).val();

    switch(val)
    {
        case 'Edit':
            window.location.href = '/documents/tax-invoices/'+id+'/edit';
        break;
        case 'Lock':
            window.location.href = '/documents/lock/'+id;
        break;
        case 'PDF':
            window.open('/documents/print/' + id, '_blank');
            break;
        case 'View':
            window.open('/documents/view/' + id, '_blank');
            break;
    }
    $('#'+id).val('');
});
$('#entity_id').select2({
    dropdownParent: '#formModal',
    placeholder: "{{__('global.pleaseSelect')}}",
    ajax: {
            url: '/search/customers',
            method: 'POST',
            dataType: 'json',
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
