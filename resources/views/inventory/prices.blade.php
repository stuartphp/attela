@extends('layouts.admin')
@section('title', __('global.menu.inventory.title'))
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-6">{{ __('global.menu.inventory.title') }} / <a href="{{ route('prices.index') }}">{{ __('inventory_prices.title')}}</a></div>
            <div class="col-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'inventory_prices_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-3 my-2 my-0 mw-100 navbar-search" action="{{ url('/inventory/prices') }}" method="get">
                    <div class="input-group">
                    <input type="text" class="form-control form-control-sm" name="search" placeholder="{{ __('global.search') }}" aria-label="Search" aria-describedby="basic-addon2" @if(isset($search)) value="{{$search}}" @endif>
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
        <table class="table table-hover" id="dataTable" width="100%">
          <thead>
            <tr>
               <th>{{__('inventory_prices.fields.inventory_item_id')}}</th>
               <th>{{__('inventory_prices.fields.store_id')}}</th>
               <th>{{__('inventory_prices.fields.cost_price')}}</th>
               <th>{{__('inventory_prices.fields.retail')}}</th>
               <th>{{__('inventory_prices.fields.dealer')}}</th>
               <th>{{__('inventory_prices.fields.whole_sale')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($data as $item)
                <tr>
                    <td>{{ $item->items->description}}</td>
                    <td>{{ $item->store->name}}</td>
                    <td>{{ $item->cost_price}}</td>
                    <td>{{ $item->retail}}</td>
                    <td>{{ $item->dealer}}</td>
                    <td>{{ $item->whole_sale}}</td>
                    <td><select class="dropdown-action form-control form-control-sm" id="{{ $item->id }}">
                        <option value="">{{ __('global.select') }}</option>
                        <option value="Edit">{{ __('global.edit') }}</option>
                        <option value="Delete">{{ __('global.delete') }}</option>
                        <option value="PDF">{{ __('global.pdf') }}</option>
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
            <div class="row">
                <div class="row mb-2">
                <label class="col-3">{{__('inventory_prices.fields.inventory_item_id')}}</label>
                <div class="col-9">
                    <input type="number" name="inventory_item_id" id="inventory_item_id" class="form-control">
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('inventory_prices.fields.store_id')}}</label>
                <div class="col-9">
                    <input type="number" name="store_id" id="store_id" class="form-control">
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('inventory_prices.fields.cost_price')}}</label>
                <div class="col-9">
                    <input type="text" name="cost_price" id="cost_price" class="form-control">
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('inventory_prices.fields.retail')}}</label>
                <div class="col-9">
                    <input type="text" name="retail" id="retail" class="form-control">
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('inventory_prices.fields.dealer')}}</label>
                <div class="col-9">
                    <input type="text" name="dealer" id="dealer" class="form-control">
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('inventory_prices.fields.whole_sale')}}</label>
                <div class="col-9">
                    <input type="text" name="whole_sale" id="whole_sale" class="form-control">
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('inventory_prices.fields.price_list1')}}</label>
                <div class="col-9">
                    <input type="text" name="price_list1" id="price_list1" class="form-control">
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('inventory_prices.fields.price_list2')}}</label>
                <div class="col-9">
                    <input type="text" name="price_list2" id="price_list2" class="form-control">
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('inventory_prices.fields.price_list3')}}</label>
                <div class="col-9">
                    <input type="text" name="price_list3" id="price_list3" class="form-control">
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('inventory_prices.fields.price_list4')}}</label>
                <div class="col-9">
                    <input type="text" name="price_list4" id="price_list4" class="form-control">
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('inventory_prices.fields.price_list5')}}</label>
                <div class="col-9">
                    <input type="text" name="price_list5" id="price_list5" class="form-control">
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('inventory_prices.fields.special')}}</label>
                <div class="col-9">
                    <input type="text" name="special" id="special" class="form-control">
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('inventory_prices.fields.special_from')}}</label>
                <div class="col-9">
                    <input type="text" name="special_from" id="special_from" class="form-control date">
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('inventory_prices.fields.special_to')}}</label>
                <div class="col-9">
                    <input type="text" name="special_to" id="special_to" class="form-control date">
                </div>
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

$(document).on('change', '.dropdown-action', function(){
    let id = $(this).attr('id');
    let val = $('#' + id).val();

    switch(val)
    {
        case 'Edit':
        $.ajax({
                url:'/inventory/prices/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val('Update');
                    $('#id').val(response.data.id);
					$('#inventory_item_id').val(response.data.inventory_item_id);
					$('#store_id').val(response.data.store_id);
					$('#cost_price').val(response.data.cost_price);
					$('#retail').val(response.data.retail);
					$('#dealer').val(response.data.dealer);
					$('#whole_sale').val(response.data.whole_sale);
					$('#price_list1').val(response.data.price_list1);
					$('#price_list2').val(response.data.price_list2);
					$('#price_list3').val(response.data.price_list3);
					$('#price_list4').val(response.data.price_list4);
					$('#price_list5').val(response.data.price_list5);
					$('#special').val(response.data.special);
					$('#special_from').val(response.data.special_from);
					$('#special_to').val(response.data.special_to);
                    $('#main_form').attr('action', '/inventory/prices/'+id);
                    $('#method').val('PUT');
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
                    $('#main_form').attr('action', '/inventory/prices/'+id);
                    $('#method').val('DELETE');
                }
            });
            break;

    }
    $('#'+id).val('');
});
</script>
@endsection
