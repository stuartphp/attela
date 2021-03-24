@extends('layouts.iframe')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-6">{{ __('setup_leave.title') }}</div>
            <div class="col-6 text-end">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'leave_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('/setup/leave') }}" method="get">
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
                <th class="col-5">{{__('setup_leave.fields.leave_type')}}</th>
                <th class="col-4">{{__('setup_leave.fields.leave_cycle')}}</th>
                <th class="col-2">{{__('setup_leave.fields.estimated_value')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($data as $item)
                <tr>
                    <td>{{ __('employee_lookup.leave.'.$item->leave_type)}}</td>
                    <td>{{ __('employee_lookup.leave_frequency.'.$item->leave_cycle)}}</td>
                    <td>{{ $item->estimated_value}}</td>
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
<input type="hidden" id="id" value="">
<input type="hidden" name="company_id" id="company_id" value="{{ session()->get('company_id') }}">
  <div class="modal" id="formModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-2">
                <label class="col-3">{{__('setup_leave.fields.leave_type')}}</label>
                <div class="col-9">
                    <select name="leave_type" id="leave_type" class="form-select">
                        @foreach (__('employee_lookup.leave') as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('setup_leave.fields.leave_cycle')}}</label>
                <div class="col-9">
                    <select name="leave_cycle" id="leave_cycle" class="form-select">
                        @foreach (__('employee_lookup.leave_frequency') as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                    </select>
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('setup_leave.fields.estimated_value')}}</label>
                <div class="col-9">
                    <input type="text" name="estimated_value" id="estimated_value" class="form-control form-control-sm">
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
                url:'/setup/leave/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val('Update');
                    $('#id').val(response.id);
                    $('#leave_type').val(response.leave_type);
                    $('#leave_cycle').val(response.leave_cycle);
                    $('#estimated_value').val(response.estimated_value);
                    $('#main_form').attr('action', '/setup/leave/'+id);
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
                    cancelButtonText: '{{ __('global.no')}}',
                    confirmButtonText: '{{ __("global.yes") }}'
                }).then((result) => {
                    if (result.value) {
                        $('#main_form').attr('action', '/setup/leave/'+id);
                        $('#method').val('DELETE');
                        $('#main_form').trigger('submit');
                    }
                });
                break;

        }
        $('#'+id).val('');
    });
    </script>
@endsection

