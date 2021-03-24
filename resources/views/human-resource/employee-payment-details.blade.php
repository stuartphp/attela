@extends('layouts.admin')
@section('title', __('global.menu.employees.title'))
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('global.menu.employees.title') }} / <a href="/human-resource/employee-payment-details">{{ __('employee_payment_details.title') }}</a></div>
            <div class="col-md-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'employee_payment_details_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('human-resource/employee-payment-details') }}" method="get">
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
               <th>{{__('employee_payment_details.fields.employee_id')}}</th>
               <th>{{__('employee_payment_details.fields.payslip_language')}}</th>
               <th>{{__('employee_payment_details.fields.bank_name')}}</th>
               <th>{{__('employee_payment_details.fields.account_holder')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @if(count($data)>0)
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->employee->surname.' '.$item->employee->initials.' ('.$item->employee->first_name.')'}}</td>
                    <td>{{ __('global.available_languages.'.$item->payslip_language)}}</td>
                    <td>{{ __('employee_lookup.bank_list.'.$item->bank_name)}}</td>
                    <td>{{ $item->account_holder}}</td>
                    <td class="col-1"><select class="dropdown-action form-control form-control-sm" id="{{ $item->id }}">
                        <option value="">{{ __('global.select') }}</option>
                        <option value="Edit">{{ __('global.edit') }}</option>
                        <option value="Delete">{{ __('global.delete') }}</option>
                        </select></td>
                </tr>
                @endforeach
              @else
                <tr><td colspan="5">{{ __('global.no_results') }}</td></tr>
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
                <label class="col-md-4">{{__('employee_payment_details.fields.employee_id')}}</label>
                <div class="col-md-8">
                    <select name="employee_id" id="employee_id" class="form-control form-control-sm employee_select"></select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4">{{__('employee_payment_details.fields.payslip_language')}}</label>
                <div class="col-md-8">
                    <select name="payslip_language" id="payslip_language" class="form-control form-control-sm">
                        @foreach (__('global.available_languages') as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_payment_details.fields.bank_branch_code')}}</label>
                <div class="col-md-8">
                    <input type="text" name="bank_branch_code" id="bank_branch_code" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_payment_details.fields.bank_name')}}</label>
                <div class="col-md-8">
                    <select name="bank_name" id="bank_name" class="form-control form-control-sm">
                        @foreach (__('employee_lookup.bank_list') as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_payment_details.fields.account_number')}}</label>
                <div class="col-md-8">
                    <input type="text" name="account_number" id="account_number" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_payment_details.fields.account_holder')}}</label>
                <div class="col-md-8">
                    <input type="text" name="account_holder" id="account_holder" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_payment_details.fields.account_holder_relationship')}}</label>
                <div class="col-md-8">
                    <select name="account_holder_relationship" id="account_holder_relationship" class="form-control form-control-sm">
                        @foreach (__('employee_lookup.relationship') as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_payment_details.fields.account_holder_id_number')}}</label>
                <div class="col-md-8">
                    <input type="text" name="account_holder_id_number" id="account_holder_id_number" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_payment_details.fields.account_type')}}</label>
                <div class="col-md-8">
                    <select name="account_type" id="account_type" class="form-control form-control-sm">
                        @foreach (__('employee_lookup.bank_account_type') as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_payment_details.fields.is_foreign_account')}}</label>
                <div class="col-md-8">
                    <select name="is_foreign_account" id="is_foreign_account" class="form-control form-control-sm">
                        @foreach (__('global.yesno') as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
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
$('#bank_name').select2({dropdownParent: '#formModal',});
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
                url:'/human-resource/employee-payment-details/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    let t = response.data.employee.title+' '+response.data.employee.surname+' '+response.data.employee.initials;
                    $('#employee').hide();
                    document.getElementById("employee_id").disabled = true;
                    $('.modal-title').html(update+' : '+t);
                    $('#action').val('Update');
                    $('#main_form').attr('action', '/human-resource/employee-payment-details/'+id);
                    $('#method').val('PUT');
                    $('#id').val(response.data.id);
					$('#employee_id').val(response.data.employee_id);
					$('#payment_method').val(response.data.payment_method);
					$('#payslip_language').val(response.data.payslip_language);
					$('#bank_branch_code').val(response.data.bank_branch_code);
					$('#bank_name').val(response.data.bank_name);
					$('#account_number').val(response.data.account_number);
					$('#account_holder').val(response.data.account_holder);
					$('#account_holder_relationship').val(response.data.account_holder_relationship);
					$('#account_holder_id_number').val(response.data.account_holder_id_number);
					$('#account_type').val(response.data.account_type);
					$('#is_foreign_account').val(response.data.is_foreign_account);
                    $('#main_form').attr('action', '/human-resource/employee-payment-details/'+id);
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
                    $('#main_form').attr('action', '/human-resource/employee-payment-details/'+id);
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
