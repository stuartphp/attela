@extends('layouts.admin')
@section('title', __('global.menu.employees.title'))
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('global.menu.employees.title') }} / <a href="/human-resource/employee-contact-details">{{ __('employee_contact_details.title') }}</a></div>
            <div class="col-md-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'employee_contact_details_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('human-resource/employee-contact-details') }}" method="get">
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
               <th>{{__('employee_contact_details.fields.employee_id')}}</th>
               <th>{{__('employee_contact_details.fields.main_number')}}</th>
               <th>{{__('employee_contact_details.fields.email')}}</th>
               <th>{{__('employee_contact_details.fields.home_number')}}</th>
               <th>{{__('employee_contact_details.fields.work_number')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @if(count($data)>0)
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->employee->surname.' '.$item->employee->initials.' ('.$item->employee->first_name.')'}}</td>
                    <td>{{ $item->main_number}}</td>
                    <td>{{ $item->email}}</td>
                    <td>{{ $item->home_number}}</td>
                    <td>{{ $item->work_number}}</td>
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

                <div class="form-group row" id="employee">
                <label class="col-md-3">{{__('employee_contact_details.fields.employee_id')}}</label>
                <div class="col-md-9">
                    <select name="employee_id" id="employee_id" class="form-control form-control-sm employee_select"></select>
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_contact_details.fields.main_number')}}</label>
                <div class="col-md-9">
                    <input type="text" name="main_number" id="main_number" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_contact_details.fields.email')}}</label>
                <div class="col-md-9">
                    <input type="text" name="email" id="email" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_contact_details.fields.home_number')}}</label>
                <div class="col-md-9">
                    <input type="text" name="home_number" id="home_number" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_contact_details.fields.work_number')}}</label>
                <div class="col-md-9">
                    <input type="text" name="work_number" id="work_number" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_contact_details.fields.mobile_number')}}</label>
                <div class="col-md-9">
                    <input type="text" name="mobile_number" id="mobile_number" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_contact_details.fields.fax_number')}}</label>
                <div class="col-md-9">
                    <input type="text" name="fax_number" id="fax_number" class="form-control form-control-sm">
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
    $('#employee').show();
    document.getElementById("employee_id").disabled = false;
    $('#formModal').modal('show');
});

$(document).on('change', '.dropdown-action', function(){
    let id = $(this).attr('id');
    let val = $('#' + id).val();

    switch(val)
    {
        case 'Edit':
        $.ajax({
                url:'/human-resource/employee-contact-details/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    let t = response.data.employee.title+' '+response.data.employee.surname+' '+response.data.employee.initials;
                    $('#employee').hide();
                    document.getElementById("employee_id").disabled = true;
                    $('.modal-title').html(update+' : '+t);
                    $('#action').val('Update');
                    $('#main_form').attr('action', '/human-resource/employee-contact-details/'+id);
                    $('#method').val('PUT');
                    $('#id').val(response.data.id);
					$('#employee_id').val(response.data.employee_id);
					$('#main_number').val(response.data.main_number);
					$('#email').val(response.data.email);
					$('#home_number').val(response.data.home_number);
					$('#work_number').val(response.data.work_number);
					$('#mobile_number').val(response.data.mobile_number);
					$('#fax_number').val(response.data.fax_number);

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
                    $('#main_form').attr('action', '/human-resource/employee-contact-details/'+id);
                    $('#method').val('DELETE');
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
