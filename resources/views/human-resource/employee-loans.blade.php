@extends('layouts.admin')
@section('title', __('global.menu.employees.title'))
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('global.menu.employees.title') }} / <a href="/human-resource/employee-loans">Employee Loans</a></div>
            <div class="col-md-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'employee_loans_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('human-resource/employee-loans') }}" method="get">
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
               <th>{{__('employee_loans.fields.employee_id')}}</th><th>{{__('employee_loans.fields.reference_number')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @if(count($data)>0)
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->employee_id}}</td><td>{{ $item->reference_number}}</td>
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
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Record</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-md-2">{{__('employee_loans.fields.employee_id')}}</label>
                <div class="col-md-10">
                    <select name="employee_id" id="employee_id" class="form-control form-control-sm employee_select"></select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                <div class="form-group row">
                <label class="col-md-4">{{__('employee_loans.fields.reference_number')}}</label>
                <div class="col-md-8">
                    <input type="text" name="reference_number" id="reference_number" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_loans.fields.issue_date')}}</label>
                <div class="col-md-8">
                    <input type="text" name="issue_date" id="issue_date" class="form-control date form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_loans.fields.start_date')}}</label>
                <div class="col-md-8">
                    <input type="text" name="start_date" id="start_date" class="form-control form-control-sm date">
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_loans.fields.end_date')}}</label>
                <div class="col-md-8">
                    <input type="text" name="end_date" id="end_date" class="form-control form-control-sm date">
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_loans.fields.start_period')}}</label>
                <div class="col-md-8">
                    <select name="start_period" id="start_period" class="form-control form-control-sm">
                        @for ($i = 1; $i < 14; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_loans.fields.end_period')}}</label>
                <div class="col-md-8">
                    <select name="end_period" id="end_period" class="form-control form-control-sm">
                        @for ($i = 1; $i < 14; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_loans.fields.total_amount_due')}}</label>
                <div class="col-md-8">
                    <input type="text" name="total_amount_due" id="total_amount_due" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_loans.fields.transaction_code')}}</label>
                <div class="col-md-8">
                    <input type="text" name="transaction_code" id="transaction_code" class="form-control form-control-sm" value="8200/020" readonly>
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_loans.fields.balance')}}</label>
                <div class="col-md-8">
                    <input type="text" name="balance" id="balance" class="form-control form-control-sm">
                </div>
            </div>
                </div>
                <div class="col"><div class="form-group row">
                <label class="col-md-4">{{__('employee_loans.fields.interest_on_amount')}}</label>
                <div class="col-md-8">
                    <input type="text" name="interest_on_amount" id="interest_on_amount" class="form-control form-control-sm">
                </div>
            </div>
<div class="form-group row">
                <label class="col-md-4">{{__('employee_loans.fields.interest_amount')}}</label>
                <div class="col-md-8">
                    <input type="text" name="interest_amount" id="interest_amount" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_loans.fields.interest_transaction_code')}}</label>
                <div class="col-md-8">
                    <input type="text" name="interest_transaction_code" id="interest_transaction_code" class="form-control form-control-sm" value="2750/009" readonly>
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_loans.fields.interest_perc')}}</label>
                <div class="col-md-8">
                    <input type="text" name="interest_perc" id="interest_perc" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_loans.fields.paid_up')}}</label>
                <div class="col-md-8">
                    <select name="paid_up" id="paid_up" class="form-control form-control-sm">
                        @foreach (__('global.yesno') as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_loans.fields.settlement_date')}}</label>
                <div class="col-md-8">
                    <input type="text" name="settlement_date" id="settlement_date" class="form-control date form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-4">{{__('employee_loans.fields.settlement_reason')}}</label>
                <div class="col-md-8">
                    <textarea name="settlement_reason" id="settlement_reason" class="form-control form-control-sm"></textarea>
                </div>
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
                url:'/human-resource/employee-loans/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val('Update');
                    $('#main_form').attr('action', '/human-resource/employee-loans/'+id);
                    $('#method').val('PUT');
                    $('#id').val(response.data.id);
					$('#company_id').val(response.data.company_id);
					$('#employee_id').val(response.data.employee_id);
					$('#reference_number').val(response.data.reference_number);
					$('#issue_date').val(response.data.issue_date);
					$('#start_date').val(response.data.start_date);
					$('#end_date').val(response.data.end_date);
					$('#start_period').val(response.data.start_period);
					$('#end_period').val(response.data.end_period);
					$('#total_amount_due').val(response.data.total_amount_due);
					$('#transaction_code').val(response.data.transaction_code);
					$('#balance').val(response.data.balance);
					$('#interest_on_amount').val(response.data.interest_on_amount);
					$('#interest_amount').val(response.data.interest_amount);
					$('#interest_transaction_code').val(response.data.interest_transaction_code);
					$('#interest_perc').val(response.data.interest_perc);
					$('#paid_up').val(response.data.paid_up);
					$('#settlement_date').val(response.data.settlement_date);
					$('#settlement_reason').val(response.data.settlement_reason);

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
                    $('#main_form').attr('action', '/human-resource/employee-loans/'+id);
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
</script>
@endsection
