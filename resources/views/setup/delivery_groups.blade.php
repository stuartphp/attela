@extends('layouts.iframe')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('settings.delivery_groups.title') }}</div>
            <div class="col-md-6 text-end">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'setup_delivery_groups_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('/setup/delivery-groups') }}" method="get">
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
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
                <th class="col-3">{{__('setup_delivery_groups.fields.name')}}</th>
                <th class="col-2">{{__('setup_delivery_groups.fields.standard_rate')}}</th>
                <th class="col-2">{{__('setup_delivery_groups.fields.standard_weight_gram')}}</th>
                <th class="col-2">{{__('setup_delivery_groups.fields.additional_cost')}}</th>
                <th class="col-2">{{__('setup_delivery_groups.fields.additional_weight_per_gram')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($data as $item)
            <tr>
                <td>{{ $item->name}}</td>
                <td>{{ $item->standard_rate}}</td>
                <td>{{ $item->standard_weight_gram}}</td>
                <td>{{ $item->additional_cost}}</td>
                <td>{{ $item->additional_weight_per_gram}}</td>
                <td><select class="dropdown-action form-select" id="{{ $item->id }}">
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
</div>
<form method="post" id="main_form" enctype="multipart/form-data">
@csrf
<input type="hidden" id="action"/>
<input type="hidden" name="_method" id="method">
<input type="hidden" id="id" value=""><input type="hidden" name="company_id" id="company_id" value="{{ session()->get('company_id') }}">
<div class="modal fade" tabindex="-1" id="formModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-2">
                <label class="col-md-5">{{__('setup_delivery_groups.fields.name')}}</label>
                <div class="col-md-7">
                    <input type="text" name="name" id="name" class="form-control form-control-sm">
                </div>
            </div><div class="row mb-2">
                <label class="col-md-5">{{__('setup_delivery_groups.fields.standard_rate')}}</label>
                <div class="col-md-7">
                    <input type="text" name="standard_rate" id="standard_rate" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
            </div><div class="row mb-2">
                <label class="col-md-5">{{__('setup_delivery_groups.fields.standard_weight_gram')}}</label>
                <div class="col-md-7">
                    <input type="text" name="standard_weight_gram" id="standard_weight_gram" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                </div>
            </div><div class="row mb-2">
                <label class="col-md-5">{{__('setup_delivery_groups.fields.additional_cost')}}</label>
                <div class="col-md-7">
                    <input type="text" name="additional_cost" id="additional_cost" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
            </div><div class="row mb-2">
                <label class="col-md-5">{{__('setup_delivery_groups.fields.additional_weight_per_gram')}}</label>
                <div class="col-md-7">
                    <input type="text" name="additional_weight_per_gram" id="additional_weight_per_gram" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
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
                    url:'/setup/delivery-groups/'+id+'/edit',
                    dataType:'JSON',
                    method: 'GET',
                    success: function (response) {
                        $('.modal-title').html(update);
                        $('#action').val('Update');
                        $('#id').val(response.data.id);
                        $('#company_id').val(response.data.company_id);
                        $('#name').val(response.data.name);
                        $('#standard_rate').val(response.data.standard_rate);
                        $('#standard_weight_gram').val(response.data.standard_weight_gram);
                        $('#additional_cost').val(response.data.additional_cost);
                        $('#additional_weight_per_gram').val(response.data.additional_weight_per_gram);
                        $('#main_form').attr('action', '/setup/delivery-groups/'+id);
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
                        $('#main_form').attr('action', '/setup/delivery-groups/'+id);
                        $('#method').val('DELETE');
                        $('#main_form').trigger('submit');
                    }
                });
                break;

        }
        $('#'+id).val('');
    });</script>
@endsection



