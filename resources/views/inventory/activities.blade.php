@extends('layouts.admin')
@section('title', __('global.menu.inventory.title'))
@section('content')
<br>
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('inventory_activities.title') }}</div>
            <div class="col-md-6 text-end">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'inventory_activities_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('/inventory/activities') }}" method="get">
                    <div class="input-group">
                        <select class="form-control form-control-sm " name="action"  aria-describedby="basic-addon2">
                            <option value="">{{ __('global.select') }}</option>
                            @foreach (__('inventory_activities.action') as $k=>$v)
                                <option value="{{ $k }}">{{ $v}}</option>
                            @endforeach
                        </select>
                        <select class="form-control form-control-sm " name="store"  aria-describedby="basic-addon2">
                            <option value="">{{ __('global.select') }}</option>
                            @foreach ($stores as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control form-control-sm " name="search" placeholder="{{ __('global.search') }}" aria-label="Search" aria-describedby="basic-addon2" @if(isset($search)) value="{{$search}}" @endif>
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
               <th>{{ __('inventory_activities.fields.action_date') }}</th>
               <th>{{ __('inventory_activities.fields.inventory_item_id') }}</th>
               <th>{{__('inventory_activities.fields.action')}}</th>
               <th>{{__('inventory_activities.fields.document_reference')}}</th>
               <th>{{__('inventory_activities.fields.store_id')}}</th>
               <th class="text-center">{{__('inventory_activities.fields.down')}}</th>
               <th class="text-center">{{__('inventory_activities.fields.up')}}</th>

            </tr>
          </thead>
          <tbody>
              @foreach ($data as $item)
                <tr>
                    <td>{{ $item->action_date }}</td>
                    <td>{{ $item->items->description }}</td>
                    <td>{{ $item->action}}</td>
                    <td>{{ $item->document_reference}}</td>
                    <td>{{ $item->store->name}}</td>
                    <td class="text-center">{{ $item->down}}</td>
                    <td class="text-center">{{ $item->up}}</td>
                </tr>
              @endforeach
          </tbody>
        </table>
    </div>
  </div>
<!-- /.box-footer-->
<div class="card-footer">{{ $data->render() }}</div>
</div>
<form method="post" id="main_form" enctype="multipart/form-data">
@csrf
<input type="hidden" id="action"/>
<input type="hidden" name="_method" id="method">
<input type="hidden" id="id" value="">
<input type="hidden" name="company_id" id="company_id" value="{{ session()->get('company_id') }}">
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
                <label class="col-md-3">{{__('inventory_activities.fields.inventory_item_id')}}</label>
                <div class="col-md-9">
                    <input type="number" name="inventory_item_id" id="inventory_item_id" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('inventory_activities.fields.action_date')}}</label>
                <div class="col-md-9">
                    <input type="text" name="action_date" id="action_date" class="form-control form-control-sm date">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('inventory_activities.fields.action')}}</label>
                <div class="col-md-9">
                    <input type="text" name="action" id="action" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('inventory_activities.fields.document_reference')}}</label>
                <div class="col-md-9">
                    <input type="text" name="document_reference" id="document_reference" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('inventory_activities.fields.store_id')}}</label>
                <div class="col-md-9">
                    <input type="number" name="store_id" id="store_id" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('inventory_activities.fields.down')}}</label>
                <div class="col-md-9">
                    <input type="text" name="down" id="down" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('inventory_activities.fields.up')}}</label>
                <div class="col-md-9">
                    <input type="text" name="up" id="up" class="form-control form-control-sm">
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
<script>
$('#create_record').click(function () {
    $('#main_form')[0].reset();
    $('.modal-title').html(add);
    $('#action').val('Add');
    $('#formModal').modal('show');
});

$(document).on('change', '.action', function(){
    let id = $(this).attr('id');
    let val = $('#' + id).val();

    switch(val)
    {
        case 'Edit':
        $.ajax({
                url:'/inventory/activities/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val('Update');
                    $('#id').val(response.data.id);
					$('#company_id').val(response.data.company_id);
					$('#inventory_item_id').val(response.data.inventory_item_id);
					$('#action_date').val(response.data.action_date);
					$('#action').val(response.data.action);
					$('#document_reference').val(response.data.document_reference);
					$('#store_id').val(response.data.store_id);
					$('#down').val(response.data.down);
					$('#up').val(response.data.up);

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
                        url: '/inventory/activities/' + id,
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
