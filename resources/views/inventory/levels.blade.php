@extends('layouts.admin')
@section('title', __('global.menu.inventory.title'))
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('global.menu.inventory.title') }} / <a href="{{ route('levels.index') }}">{{ __('inventory_levels.title') }}</a> </div>
            <div class="col-md-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'inventory_levels_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('/inventory/levels') }}" method="get">
                    <div class="input-group">
                    <input type="text" class="form-control form-control-sm form-control form-control-sm-sm" name="search" placeholder="{{ __('global.search') }}" aria-label="Search" aria-describedby="basic-addon2" @if(isset($search)) value="{{$search}}" @endif>
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
               <th>{{__('inventory_levels.fields.inventory_item_id')}}</th><th>{{__('inventory_levels.fields.store_id')}}</th>
               <th class="text-center">{{__('inventory_levels.fields.on_hand')}}</th><th class="text-center">{{__('inventory_levels.fields.min_order_level')}}</th>
               <th class="text-center">{{__('inventory_levels.fields.min_order_quantity')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($data as $item)
              <tr>
                <td>{{ $item->items->description}}</td>
                <td>{{ $item->store->name}}</td>
                <td class="text-center">{{ $item->on_hand}}</td>
                <td class="text-center">{{ $item->min_order_level}}</td>
                <td class="text-center">{{ $item->min_order_quantit}}</td>
                <td><select class="action form-control form-control-sm" id="{{ $item->id }}">
                    <option value="">{{ __('global.select') }}</option>
                    <option value="Edit">{{ __('global.edit') }}</option>
                    </select></td>
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
                <label class="col-md-3">{{__('inventory_levels.fields.inventory_item_id')}}</label>
                <div class="col-md-9">
                    <input type="number" name="inventory_item_id" id="inventory_item_id" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('inventory_levels.fields.store_id')}}</label>
                <div class="col-md-9">
                    <input type="number" name="store_id" id="store_id" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('inventory_levels.fields.on_hand')}}</label>
                <div class="col-md-9">
                    <input type="text" name="on_hand" id="on_hand" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('inventory_levels.fields.min_order_level')}}</label>
                <div class="col-md-9">
                    <input type="text" name="min_order_level" id="min_order_level" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('inventory_levels.fields.min_order_quantity')}}</label>
                <div class="col-md-9">
                    <input type="text" name="min_order_quantity" id="min_order_quantity" class="form-control form-control-sm">
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
                url:'/inventory/levels/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val('Update');
                    $('#id').val(response.data.id);
					$('#inventory_item_id').val(response.data.inventory_item_id);
					$('#store_id').val(response.data.store_id);
					$('#on_hand').val(response.data.on_hand);
					$('#min_order_level').val(response.data.min_order_level);
					$('#min_order_quantity').val(response.data.min_order_quantity);
                    $('#main_form').attr('action', '/inventory/levels/'+id);
                    $('#method').val('PUT');
                }
            });
            $('#formModal').modal('show');
            break;

    }
    $('#'+id).val('');
});
</script>
@endsection
