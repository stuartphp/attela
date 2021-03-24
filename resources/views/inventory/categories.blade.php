@extends('layouts.admin')
@section('title', __('global.menu.inventory.title'))
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('global.menu.inventory.title') }} / <a href="{{ route('categories.index') }}">{{ __('inventory_categories.title') }}</a> </div>
            <div class="col-md-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'inventory_categories_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('/inventory/categories') }}" method="get">
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
               <th>{{__('inventory_categories.fields.main_category')}}</th>
               <th>{{__('inventory_categories.fields.sub_category')}}</th>
               <th>{{__('inventory_categories.fields.is_active')}}</th>
               <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($data as $item)
                <tr>
                    <td>{{ $item->main_category}}</td>
                    <td>{{ $item->sub_category}}</td>
                    <td>{{ ($item->is_active==1) ? __('global.yes'): __('global.no')}}</td>
                    <td><select class="dropdown-action form-control form-control-sm" id="{{ $item->id }}">
                        <option value="">{{ __('global.select') }}</option>
                        <option value="Edit">{{ __('global.edit') }}</option>
                        <option value="Delete">{{ __('global.delete') }}</option>
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
                <label class="col-md-3">{{__('inventory_categories.fields.main_category')}}</label>
                <div class="col-md-9">
                    <select id="main_category" name="main_category" class="select form-control form-control-sm" tags="true" >
                        @foreach($main as $k=>$v)
                            <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('inventory_categories.fields.sub_category')}}</label>
                <div class="col-md-9">
                    <input type="text" name="sub_category" id="sub_category" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('inventory_categories.fields.is_active')}}</label>
                <div class="col-md-9">
                    <select class="form-control form-control-sm" id="is_active" name="is_active">
                        @foreach(__('global.yesno') as $k=>$v)
                            <option value="{{$k}}">{{$v}}</option>
                            @endforeach

                    </select>
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
    $('#formModal').modal('show');
});



$(document).on('change', '.dropdown-action', function(){
    let id = $(this).attr('id');
    let val = $('#' + id).val();

    switch(val)
    {
        case 'Edit':
        $.ajax({
                url:'/inventory/categories/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val('Update');
                    $('#id').val(response.data.id);
					$('#company_id').val(response.data.company_id);
					$('#main_category').val(response.data.main_category).trigger('change');
					$('#sub_category').val(response.data.sub_category);
					$('#is_active').val(response.data.is_active);
                    $('#main_form').attr('action', '/inventory/categories/'+id);
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
                    $('#main_form').attr('action', '/inventory/categories/'+id);
                    $('#method').val('DELETE');
                }
            });
            break;

    }
    $('#'+id).val('');
});
</script>
@endsection
