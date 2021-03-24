@extends('layouts.iframe')
@section('title', __('global.menu.payroll.title'))
@section('content')
<div class="card shadow">
    <div class="card-header">
        <div class="row">
            <div class="col-6"><a href="/setup/payroll-transaction-codes">Payroll Transaction Codes</a></div>
            <div class="col-6 text-end">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'payroll_transaction_codes_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('setup/payroll-transaction-codes') }}" method="get">
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
                <th class="col-1">{{__('payroll_transaction_codes.fields.irp5_code')}}</th>
                <th>{{__('payroll_transaction_codes.fields.irp5_description')}}</th>
                <th class="col-1">{{__('payroll_transaction_codes.fields.transaction_code')}}</th>
                <th>{{__('payroll_transaction_codes.fields.description')}}</th>
                <th class="col-1">{{__('payroll_transaction_codes.fields.transaction_type')}}</th>
                <th class="col-1">{{__('payroll_transaction_codes.fields.effective_from')}}</th>
                <th class="col-1">{{__('payroll_transaction_codes.fields.effective_to')}}</th>
                <th class="col-1">{{__('payroll_transaction_codes.fields.taxability')}}</th>
                <th class="col-1 text-center">{{__('payroll_transaction_codes.fields.taxable')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @if(count($data)>0)
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->irp5_code }}</td>
                    <td>{{ $item->irp5_description }}</td>
                    <td>{{ ($item->own_transaction_code) ? $item->own_transaction_code: $item->transaction_code}}</td>
                    <td>{{ $item->description}}</td>
                    <td>{{ __('payroll_transaction_codes.transaction_type.'.$item->transaction_type) }}</td>
                    <td>{{ $item->effective_from }}</td>
                    <td>{{ $item->effective_to }}</td>
                    <td>{{ __('payroll_transaction_codes.taxability.'.$item->taxability) }}</td>
                    <td class="text-center">{{ $item->taxable }}</td>
                    <td class="col-1"><select class="dropdown-action form-select" id="{{ $item->id }}">
                        <option value="">{{ __('global.select') }}</option>
                        <option value="Copy">{{ __('global.copy') }}</option>
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
<input type="hidden" name="company_id" id="company_id" value="0">

  <div class="modal" id="formModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-2">
                <label class="col-2">{{__('payroll_transaction_codes.fields.irp5_code')}}</label>
                <div class="col-2">
                    <input type="text" name="irp5_code" id="irp5_code" class="form-control form-control-sm">
                </div>
                <label class="col-2">{{__('payroll_transaction_codes.fields.irp5_description')}}</label>
                <div class="col-6">
                    <input type="text" name="irp5_description" id="irp5_description" class="form-control form-control-sm">
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-2">{{__('payroll_transaction_codes.fields.transaction_code')}}</label>
                <div class="col-2">
                    <input type="text" name="transaction_code" id="transaction_code" class="form-control form-control-sm">
                </div>
<label class="col-2">{{__('payroll_transaction_codes.fields.transaction_type')}}</label>
                <div class="col-4">
                    <select name="transaction_type" id="transaction_type" class="form-select">
                        @foreach (__('payroll_transaction_codes.transaction_type') as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="row mb-2">
                <label class="col-2">{{__('payroll_transaction_codes.fields.description')}}</label>
                <div class="col-5">
                    <input type="text" name="description" id="description" class="form-control form-control-sm">
                </div>
                <label class="col-2">{{__('payroll_transaction_codes.fields.effective_from')}}</label>
                <div class="col-3">
                    <input type="text" name="effective_from" id="effective_from" class="form-control date form-control-sm">
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-2">{{__('payroll_transaction_codes.fields.report_description')}}</label>
                <div class="col-5">
                    <input type="text" name="report_description" id="report_description" class="form-control form-control-sm">
                </div>

                <label class="col-2">{{__('payroll_transaction_codes.fields.effective_to')}}</label>
                <div class="col-3">
                    <input type="text" name="effective_to" id="effective_to" class="form-control date form-control-sm">
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-2">{{__('payroll_transaction_codes.fields.payslip_description')}}</label>
                <div class="col-5">
                    <input type="text" name="payslip_description" id="payslip_description" class="form-control form-control-sm">
                </div>
                <label class="col-3">{{__('payroll_transaction_codes.fields.directive_mandatory')}}</label>
                <div class="col-2">
                    <select name="directive_mandatory" id="directive_mandatory" class="form-select">
                        @foreach (__('global.yesno') as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>

            </div><div class="row mb-2">
<label class="col-2">{{__('payroll_transaction_codes.fields.taxability')}}</label>
                <div class="col-2">
                    <select name="taxability" id="taxability" class="form-select">
                        @foreach (__('payroll_transaction_codes.taxability') as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="col-2">{{__('payroll_transaction_codes.fields.taxable')}}</label>
                <div class="col-2">
                    <input type="number" name="taxable" id="taxable" class="form-control form-control-sm">
                </div>
                <label class="col-2">{{__('payroll_transaction_codes.fields.oid_include')}}</label>
                <div class="col-2">
                    <select name="oid_include" id="oid_include" class="form-select">
                        @foreach (__('global.yesno') as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="row mb-2">
                <label class="col-2">{{__('payroll_transaction_codes.fields.uif_include')}}</label>
                <div class="col-2">
                    <select name="uif_include" id="uif_include" class="form-select">
                        @foreach (__('global.yesno') as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="col-2">{{__('payroll_transaction_codes.fields.uif_use_tax')}}</label>
                <div class="col-2">
                    <input type="text" name="uif_use_tax" id="uif_use_tax" class="form-control form-control-sm">
                </div>
                <label class="col-2">{{__('payroll_transaction_codes.fields.sdl_include')}}</label>
                <div class="col-2">
                    <select name="sdl_include" id="sdl_include" class="form-select">
                        @foreach (__('global.yesno') as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="row mb-2">
                <label class="col-2">{{__('payroll_transaction_codes.fields.sdl_use_tax')}}</label>
                <div class="col-2">
                    <input type="text" name="sdl_use_tax" id="sdl_use_tax" class="form-control form-control-sm">
                </div>
                <label class="col-2">{{__('payroll_transaction_codes.fields.rf_lable_include')}}</label>
                <div class="col-2">
                    <select name="rf_lable_include" id="rf_lable_include" class="form-select">
                        @foreach (__('global.yesno') as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>

                <label class="col-2">{{__('payroll_transaction_codes.fields.rf_lable_use_tax')}}</label>
                <div class="col-2">
                    <input type="text" name="rf_lable_use_tax" id="rf_lable_use_tax" class="form-control form-control-sm">
                </div>
            </div><div class="row mb-2">
                <label class="col-2">{{__('payroll_transaction_codes.fields.eti_include')}}</label>
                <div class="col-2">
                    <select name="eti_include" id="eti_include" class="form-select">
                        @foreach (__('global.yesno') as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="col-2">{{__('payroll_transaction_codes.fields.eti_use_tax')}}</label>
                <div class="col-2">
                    <input type="text" name="eti_use_tax" id="eti_use_tax" class="form-control form-control-sm">
                </div>
                <label class="col-2">{{__('payroll_transaction_codes.fields.multiplier')}}</label>
                <div class="col-2">
                    <input type="text" name="multiplier" id="multiplier" class="form-control form-control-sm">
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
        case 'Copy':
        $.ajax({
                url:'/payroll/payroll-transaction-codes/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(add);
                    $('#action').val('Update');
                    //$('#main_form').attr('action', '/payroll/payroll-transaction-codes/'+id);
                    //$('#method').val('PUT');
                    //$('#id').val(response.data.id);
					$('#company_id').val(response.data.company_id);
					$('#transaction_code').val(response.data.transaction_code);
					$('#description').val(response.data.description);
					$('#transaction_type').val(response.data.transaction_type);
					$('#report_description').val(response.data.report_description);
					$('#payslip_description').val(response.data.payslip_description);
					$('#irp5_code').val(response.data.irp5_code);
					$('#irp5_description').val(response.data.irp5_description);
					$('#effective_from').val(response.data.effective_from);
					$('#effective_to').val(response.data.effective_to);
					$('#taxability').val(response.data.taxability);
					$('#taxable').val(response.data.taxable);
					$('#directive_mandatory').val(response.data.directive_mandatory);
					$('#oid_include').val(response.data.oid_include);
					$('#uif_include').val(response.data.uif_include);
					$('#uif_use_tax').val(response.data.uif_use_tax);
					$('#sdl_include').val(response.data.sdl_include);
					$('#sdl_use_tax').val(response.data.sdl_use_tax);
					$('#rf_lable_include').val(response.data.rf_lable_include);
					$('#rf_lable_use_tax').val(response.data.rf_lable_use_tax);
					$('#eti_include').val(response.data.eti_include);
					$('#eti_use_tax').val(response.data.eti_use_tax);
					let m = parseFloat(response.data.multiplier)/100;
                    if(m===NaN) m=1;
                    $('#multiplier').val(m);
                }
            });
            $('#formModal').modal('show');
            break;
        case 'Edit':
        $.ajax({
                url:'/payroll/payroll-transaction-codes/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val('Update');
                    $('#main_form').attr('action', '/payroll/payroll-transaction-codes/'+id);
                    $('#method').val('PUT');
                    $('#id').val(response.data.id);
					$('#company_id').val(response.data.company_id);
					$('#transaction_code').val(response.data.transaction_code);
					$('#description').val(response.data.description);
					$('#transaction_type').val(response.data.transaction_type);
					$('#report_description').val(response.data.report_description);
					$('#payslip_description').val(response.data.payslip_description);
					$('#irp5_code').val(response.data.irp5_code);
					$('#irp5_description').val(response.data.irp5_description);
					$('#effective_from').val(response.data.effective_from);
					$('#effective_to').val(response.data.effective_to);
					$('#taxability').val(response.data.taxability);
					$('#taxable').val(response.data.taxable);
					$('#directive_mandatory').val(response.data.directive_mandatory);
					$('#oid_include').val(response.data.oid_include);
					$('#uif_include').val(response.data.uif_include);
					$('#uif_use_tax').val(response.data.uif_use_tax);
					$('#sdl_include').val(response.data.sdl_include);
					$('#sdl_use_tax').val(response.data.sdl_use_tax);
					$('#rf_lable_include').val(response.data.rf_lable_include);
					$('#rf_lable_use_tax').val(response.data.rf_lable_use_tax);
					$('#eti_include').val(response.data.eti_include);
					$('#eti_use_tax').val(response.data.eti_use_tax);
                    let m = parseFloat(response.data.multiplier)/100;
                    if(m===NaN) m=1;
                    $('#multiplier').val(m);
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
                    $('#main_form').attr('action', '/payroll/payroll-transaction-codes/'+id);
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
