@extends('layouts.iframe')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-6">{{ __('global.menu.accounting.title') }} / {{ __('counters.title') }}</div>

        </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
                <th class="col-7">{{__('counters.fields.name')}}</th>
                <th class="col-2">{{__('counters.fields.prefix')}}</th>
                <th class="col-2">{{__('counters.fields.number')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
        <tbody>
            @foreach ($data as $item)
            @if($item->name != 'transactions')
            <tr>
                <td>{{ __('accounting_lookup.documents.'.$item->name)}}</td>
                <td>{{ $item->prefix}}</td>
                <td>{{ $item->number}}</td>
                <td><select class="action form-select" id="{{ $item->id }}">
                    <option value="">{{ __('global.select') }}</option>
                    <option value="Edit">{{ __('global.edit') }}</option>
                    <option value="View">{{ __('global.view') }}</option>
                    </select></td>
            </tr>
            @endif

            @endforeach
        </tbody>
        </table>
    </div>
  </div>
<!-- /.box-footer-->
</div>
<form method="post" id="main_form" enctype="multipart/form-data">
@csrf
<input type="hidden" id="action"/>
<input type="hidden" name="_method" id="method">
<input type="hidden" id="id" value=""><input type="hidden" name="company_id" id="company_id" value="{{ session()->get('company-id') }}">

  <div class="modal fade" id="formModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-2">
                <label class="col-3">{{__('counters.fields.prefix')}}</label>
                <div class="col-9">
                    <input type="text" name="prefix" id="prefix" class="form-control form-control-sm">
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('counters.fields.number')}}</label>
                <div class="col-9">
                    <input type="number" name="number" id="number" class="form-control form-control-sm">
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
@endsection
@section('scripts')
<script>

$('#create_record').click(function () {
    $('#main_form')[0].reset();
    $('.modal-title').html(add);
    $('#action').val(add);
    $('#formModal').modal('show');
});

$(document).on('change', '.action', function(){
    let id = $(this).attr('id');
    let val = $('#' + id).val();

    switch(val)
    {
        case 'Edit':
        $.ajax({
                url:'/setup/counters/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    let name = ucwords(response.data.name);
                    $('.modal-title').html(update+': '+name);
                    $('#action').val(update);
                    $('#id').val(response.data.id);
					$('#company_id').val(response.data.company_id);
                    $('#main_form').attr('action', "/accounting/counters/"+id);
                    $('#method').val('PUT');
					$('#prefix').val(response.data.prefix);
					$('#number').val(response.data.number);
					$('#deleted_at').val(response.data.deleted_at);

                }
            });
            $('#formModal').modal('show');
            break;

    }
    $('#'+id).val('');
});
</script>
@endsection
