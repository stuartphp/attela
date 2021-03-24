@extends('layouts.admin')
@section('title', __('global.menu.employees.title'))
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('global.menu.employees.title') }} / <a href="/human-resource/employee-leave-registers">{{ __('employee_leave_registers.title') }}</a></div>
            <div class="col-md-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'employee_leave_registers_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('human-resource/employee-leave-registers') }}" method="get">
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
               <th>{{__('employee_leave_registers.fields.employee_id')}}</th>
               <th>{{__('employee_leave_registers.fields.leave_type')}}</th>
               <th>{{__('employee_leave_registers.fields.from_date')}}</th>
               <th>{{__('employee_leave_registers.fields.to_date')}}</th>
               <th>{{__('employee_leave_registers.fields.total_days')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @if(count($data)>0)
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->employee->surname.' '.$item->employee->initials.' ('.$item->employee->first_name.')'}}</td>
                    <td>{{ __('employee_lookup.leave.'.$item->leave_type)}}</td>
                    <td>{{ $item->from_date}}</td>
                    <td>{{ $item->to_date}}</td>
                    <td>{{ $item->total_days}}</td>
                    <td class="col-1"><select class="dropdown-action form-control form-control-sm" id="{{ $item->id }}">
                        <option value="">{{ __('global.select') }}</option>
                        <option value="Edit">{{ __('global.edit') }}</option>
                        <option value="Delete">{{ __('global.delete') }}</option>
                        </select></td>
                </tr>
                @endforeach
              @else
                <tr><td colspan="6">{{ __('global.no_results') }}</td></tr>
              @endif
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
                <label class="col-md-3">{{__('employee_leave_registers.fields.employee_id')}}</label>
                <div class="col-md-9">
                    <select name="employee_id" id="employee_id" class="form-control form-control-sm employee_select" onchange="getLeave(this.value)"></select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3">Available</label>
                <div class="col-md-9" id="leave_results"></div>
            </div>
            <div class="form-group row">
                <label class="col-md-3">{{__('employee_leave_registers.fields.leave_type')}}</label>
                <div class="col-md-9">
                    <select type="text" name="leave_type" id="leave_type" class="form-control form-control-sm">
                        <option value="">{{ __('global.pleaseSelect') }}</option>
                        @foreach (__('employee_lookup.leave') as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_leave_registers.fields.from_date')}}</label>
                <div class="col-md-9">
                    <input type="text" name="from_date" id="from_date" class="form-control date form-control-sm" value="{{ date('Y-m-d') }}">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_leave_registers.fields.to_date')}}</label>
                <div class="col-md-9">
                    <input type="text" name="to_date" id="to_date" class="form-control date form-control-sm" value="{{ date('Y-m-d') }}">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_leave_registers.fields.total_days')}}</label>
                <div class="col-md-9">
                    <input type="text" name="total_days" id="total_days" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_leave_registers.fields.reason')}}</label>
                <div class="col-md-9">
                    <textarea name="reason" id="reason" class="form-control form-control-sm"></textarea>
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

function getLeave(id)
{
    $.ajax({
        url: '/human-resource/employee-leaves/get-leave/'+id,
        dataType:'JSON',
        modal:'GET',
        success: function(response){
            document.getElementById("leave_results").innerHTML =''+response+'';
        }
    });
}

document.getElementById('from_date').onkeypress=function(){
    alert('changed');
}

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
                url:'/human-resource/employee-leave-registers/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val('Update');
                    $('#main_form').attr('action', '/human-resource/employee-leave-registers/'+id);
                    $('#method').val('PUT');
                    $('#id').val(response.data.id);
					$('#company_id').val(response.data.company_id);
					$('#employee_id').val(response.data.employee_id);
					$('#leave_type').val(response.data.leave_type);
					$('#from_date').val(response.data.from_date);
					$('#to_date').val(response.data.to_date);
					$('#total_days').val(response.data.total_days);
					$('#reason').val(response.data.reason);
                    $('#main_form').attr('action', '/human-resource/employee-leave-registers/'+id);
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
                confirmButtonText: '{{ __("global.yes")}}'
            }).then((result) => {
                if (result.value) {
                    $('#main_form').attr('action', '/human-resource/employee-leave-registers/'+id);
                    $('#method').val('DELETE');
                    $('#main_form').trigger('submit');
                }
            });
            break;

    }
    $('#'+id).val('');
});
$('.employee_select').select2({
    dropdownParent: '#formModal',
    placeholder: "{{ __('global.pleaseSelect') }}",
    ajax: {
        url: '/search/employees',
        method: 'POST',
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
