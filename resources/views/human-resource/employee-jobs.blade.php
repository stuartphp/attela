@extends('layouts.admin')
@section('title', __('global.menu.employees.title'))
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('global.menu.employees.title') }} / <a href="/human-resource/employee-jobs">{{ __('employee_jobs.title') }}</a></div>
            <div class="col-md-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'employee_jobs_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('human-resource/employee-jobs') }}" method="get">
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
               <th>{{__('employee_jobs.fields.employee_id')}}</th>
               <th>{{__('employee_jobs.fields.effective_date')}}</th>
               <th>{{__('employee_jobs.fields.job_title')}}</th>
               <th>{{__('employee_jobs.fields.store_id')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @if(count($data)>0)
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->employee->surname.' '.$item->employee->initials.' ('.$item->employee->first_name.')'}}</td>
                    <td>{{ $item->effective_date}}</td>
                    <td>{{ $item->job_title}}</td>
                    <td>{{ $item->store->name}}</td>
                    <td class="col-1"><select class="dropdown-action form-control form-control-sm" id="{{ $item->id }}">
                        <option value="">{{ __('global.select') }}</option>
                        <option value="Edit">{{ __('global.edit') }}</option>
                        <option value="Delete">{{ __('global.delete') }}</option>
                        </select></td>
                </tr>
                @endforeach
              @else

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
                <label class="col-md-3">{{__('employee_jobs.fields.employee_id')}}</label>
                <div class="col-md-9">
                    <select name="employee_id" id="employee_id" class="form-control form-control-sm employee_select"></select>
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_jobs.fields.effective_date')}}</label>
                <div class="col-md-9">
                    <input type="text" name="effective_date" id="effective_date" class="form-control date form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_jobs.fields.job_title')}}</label>
                <div class="col-md-9">
                    <input type="text" name="job_title" id="job_title" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_jobs.fields.store_id')}}</label>
                <div class="col-md-9">
                    <select name="store_id" id="store_id" class="form-control form-control-sm">
                        @foreach ($stores as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_jobs.fields.job_division')}}</label>
                <div class="col-md-9">
                    <input type="text" name="job_division" id="job_division" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_jobs.fields.job_department')}}</label>
                <div class="col-md-9">
                    <input type="text" name="job_department" id="job_department" class="form-control form-control-sm">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3">{{__('employee_jobs.fields.reports_to')}}</label>
                <div class="col-md-9">
                    <select name="reports_to" id="reports_to" class="form-control form-control-sm reports_to_select">
                    </select>
                </div>
            </div>

            {{-- <div class="form-group row">
                <label class="col-md-3">{{__('employee_jobs.fields.compensation_pay_rate')}}</label>
                <div class="col-md-9">
                    <input type="text" name="compensation_pay_rate" id="compensation_pay_rate" class="form-control form-control-sm">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3">{{__('employee_jobs.fields.compensation_pay_type')}}</label>
                <div class="col-md-9">
                    <select name="compensation_pay_type" id="compensation_pay_type" class="form-control form-control-sm">@foreach (__('employee_lookup.compensation_pay_type') as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3">{{__('employee_jobs.fields.compensation_pay_per')}}</label>
                <div class="col-md-9">
                    <select name="compensation_pay_per" id="compensation_pay_per" class="form-control form-control-sm">@foreach (__('employee_lookup.compensation_pay_per') as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_jobs.fields.compensation_pay_schedule')}}</label>
                <div class="col-md-9">
                    <select name="compensation_pay_schedule" id="compensation_pay_schedule" class="form-control form-control-sm">@foreach (__('employee_lookup.compensation_pay_schedule') as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_jobs.fields.overtime_allowed')}}</label>
                <div class="col-md-9">
                    <select name="overtime_allowed" id="overtime_allowed" class="form-control form-control-sm">
                        @foreach (__('global.yesno') as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div> --}}
            <div class="form-group row">
                <label class="col-md-3">{{__('employee_jobs.fields.change_reason')}}</label>
                <div class="col-md-9">
                    <textarea name="change_reason" id="change_reason" class="form-control form-control-sm"></textarea>
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
                url:'/human-resource/employee-jobs/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val('Update');
                    $('#main_form').attr('action', '/human-resource/employee-jobs/'+id);
                    $('#method').val('PUT');
                    $('#id').val(response.data.id);
					$('#company_id').val(response.data.company_id);
					$('#employee_id').val(response.data.employee_id);
					$('#effective_date').val(response.data.effective_date);
					$('#job_title').val(response.data.job_title);
					$('#store_id').val(response.data.store_id);
					$('#job_division').val(response.data.job_division);
					$('#job_department').val(response.data.job_department);
					$('#reports_to').val(response.data.reports_to);
					$('#compensation_pay_rate').val(response.data.compensation_pay_rate);
					$('#compensation_pay_per').val(response.data.compensation_pay_per);
					$('#compensation_pay_schedule').val(response.data.compensation_pay_schedule);
					$('#overtime_allowed').val(response.data.overtime_allowed);
					$('#change_reason').val(response.data.change_reason);

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
                    $('#main_form').attr('action', '/human-resource/employee-jobs/'+id);
                    $('#method').val('DELETE');
                }
            });
            break;

    }
    $('#'+id).val('');
});
$('.employee_select').select2({
    dropdownParent: '#formModal',
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
$('.reports_to_select').select2({
    dropdownParent: '#formModal',
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
