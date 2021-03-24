@extends('layouts.admin')
@section('title', __('global.menu.payroll.title'))
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('global.menu.payroll.title') }} / <a href="/payroll/payroll-template">Payroll Template</a></div>
            <div class="col-md-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'payroll_templates_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('payroll/payroll-template') }}" method="get">
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
               <th>{{__('payroll_templates.fields.employee_id')}}</th><th>{{__('payroll_templates.fields.transaction_id')}}</th><th>{{__('payroll_templates.fields.amount')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @if(count($data)>0)
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->employee_id}}</td><td>{{ $item->transaction_id}}</td><td>{{ $item->amount}}</td>
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
                <label class="col-md-3">{{__('payroll_templates.fields.employee_id')}}</label>
                <div class="col-md-9">
                    <input type="number" name="employee_id" id="employee_id" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('payroll_templates.fields.transaction_id')}}</label>
                <div class="col-md-9">
                    <input type="number" name="transaction_id" id="transaction_id" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('payroll_templates.fields.amount')}}</label>
                <div class="col-md-9">
                    <input type="text" name="amount" id="amount" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('payroll_templates.fields.tax_percentage')}}</label>
                <div class="col-md-9">
                    <input type="text" name="tax_percentage" id="tax_percentage" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('payroll_templates.fields.tax_code')}}</label>
                <div class="col-md-9">
                    <input type="text" name="tax_code" id="tax_code" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('payroll_templates.fields.tax_description')}}</label>
                <div class="col-md-9">
                    <input type="text" name="tax_description" id="tax_description" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('payroll_templates.fields.transaction_description')}}</label>
                <div class="col-md-9">
                    <input type="text" name="transaction_description" id="transaction_description" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('payroll_templates.fields.directive_percentage')}}</label>
                <div class="col-md-9">
                    <input type="text" name="directive_percentage" id="directive_percentage" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('payroll_templates.fields.retirement_fund_include')}}</label>
                <div class="col-md-9">
                    <input type="text" name="retirement_fund_include" id="retirement_fund_include" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('payroll_templates.fields.only_periods')}}</label>
                <div class="col-md-9">
                    <input type="number" name="only_periods" id="only_periods" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('payroll_templates.fields.nocash')}}</label>
                <div class="col-md-9">
                    <input type="text" name="nocash" id="nocash" class="form-control form-control-sm">
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
                url:'/payroll/payroll-template/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val('Update');
                    $('#main_form').attr('action', '/payroll/payroll-template/'+id);
                    $('#method').val('PUT');
                    $('#id').val(response.data.id);
					$('#employee_id').val(response.data.employee_id);
					$('#transaction_id').val(response.data.transaction_id);
					$('#amount').val(response.data.amount);
					$('#tax_percentage').val(response.data.tax_percentage);
					$('#tax_code').val(response.data.tax_code);
					$('#tax_description').val(response.data.tax_description);
					$('#transaction_description').val(response.data.transaction_description);
					$('#directive_percentage').val(response.data.directive_percentage);
					$('#retirement_fund_include').val(response.data.retirement_fund_include);
					$('#only_periods').val(response.data.only_periods);
					$('#nocash').val(response.data.nocash);

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
                    $('#main_form').attr('action', '/payroll/payroll-template/'+id);
                    $('#method').val('DELETE');
                }
            });
            break;

    }
    $('#'+id).val('');
});
</script>
@endsection
