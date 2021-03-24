<form method="post" class="ms-2 me-2" id="form_empl_payment_detail" enctype="multipart/form-data">
    @csrf
    <input name="id" type="hidden" id="pay_id" value="{{ $payment_detail->id ?? '0' }}">
    <input type="hidden" name="_method" id="pay_method">
    <input type="hidden" name="employee_id" id="pay_employee_id">
    <div class="form-heading mt-2">{{ __('employee_payment_details.title') }}</div>
<div class="row mb-2">
        <label class="col-2">{{__('employee_payment_details.fields.payslip_language')}}</label>
        <div class="col-2">
            <select name="payslip_language" id="payslip_language" class="form-select">
                @foreach (__('global.available_languages') as $k=>$v)
                <option value="{{ $k }}"@if(isset($payment_detail->payslip_language) && $payment_detail->payslip_language==$k) selected @endif>{{ $v }}</option>
                @endforeach
            </select>
        </div>
        <label class="col-2">{{__('employee_payment_details.fields.bank_branch_code')}}</label>
        <div class="col-2">
            <input type="text" name="bank_branch_code" id="bank_branch_code" class="form-control form-control-sm" value="{{ $payment_detail->bank_branch_code ??'' }}">
        </div>
        <label class="col-2">{{__('employee_payment_details.fields.bank_name')}}</label>
        <div class="col-2">
            <select name="bank_name" id="bank_name" class="form-select">
                @foreach (__('employee_lookup.bank_list') as $k=>$v)
                <option value="{{ $k }}"@if(isset($payment_detail->bank_name) && $payment_detail->bank_name==$k) selected @endif>{{ $v }}</option>
                @endforeach
            </select>
        </div>
</div>
<div class="row mb-2">
        <label class="col-2">{{__('employee_payment_details.fields.account_number')}}</label>
        <div class="col-2">
            <input type="text" name="account_number" id="account_number" class="form-control form-control-sm" value="{{ $payment_detail->account_number ??'' }}">
        </div>

        <label class="col-2">{{__('employee_payment_details.fields.account_holder')}}</label>
        <div class="col-2">
            <input type="text" name="account_holder" id="account_holder" class="form-control form-control-sm" value="{{ $payment_detail->account_holder ??'' }}">
        </div>

        <label class="col-2">{{__('employee_payment_details.fields.account_holder_relationship')}}</label>
        <div class="col-2">
            <select name="account_holder_relationship" id="account_holder_relationship" class="form-select">
                @foreach (__('employee_lookup.relationship') as $k=>$v)
                <option value="{{ $k }}"@if(isset($payment_detail->account_holder_relationship) && $payment_detail->account_holder_relationship==$k) selected @endif>{{ $v }}</option>
                @endforeach
            </select>
        </div>
</div>
<div class="row mb-2">
    <label class="col-2">{{__('employee_payment_details.fields.account_holder_id_number')}}</label>
    <div class="col-2">
        <input type="text" name="account_holder_id_number" id="account_holder_id_number" class="form-control form-control-sm" value="{{ $payment_detail->account_holder_id_number ??'' }}">
    </div>

    <label class="col-2">{{__('employee_payment_details.fields.account_type')}}</label>
    <div class="col-2">
        <select name="account_type" id="account_type" class="form-select">
            @foreach (__('employee_lookup.bank_account_type') as $k=>$v)
            <option value="{{ $k }}"@if(isset($payment_detail->account_type) && $payment_detail->account_type==$k) selected @endif>{{ $v }}</option>
            @endforeach
        </select>
    </div>

    <label class="col-2">{{__('employee_payment_details.fields.is_foreign_account')}}</label>
    <div class="col-2">
        <div class="form-check">
            <input type="checkbox" name="is_foreign_account" id="is_foreign_account" class="form-check-input" @if(isset($payment_detail->is_foreign_account) && $payment_detail->is_foreign_account==1) checked @endif>
        </div>
    </div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-outline-primary btn-sm" >{{ __('global.save') }}</button>
</div>
</form>
<script>
$('#account_holder_relationship').on('change', function(){
    if($('#account_holder_relationship').val()>0){
        document.getElementById("account_holder_id_number").required = true;
    }else{
        document.getElementById("account_holder_id_number").required = false;
    }
});


$('#form_empl_payment_detail').on('submit', function (event) {
    event.preventDefault();
    $('#pay_method').val('PUT');
    let id = $('#employee_id').val();
    $('#pay_employee_id').val(id);

    $.ajax({
        url: "/human-resource/employee-payment-details/"+$('#pay_id').val(),
        method:'POST',
        data: new FormData(this),
        processData:false,
        contentType: false,
        cache: false,
        dataType: 'JSON',
        success: function(response)
        {
            if(response.success){
                notice('success', '{{__('global.record_updated')}}');
            }else{
                let err='<ul class="text-left">';
                for(let i=0; i<response.errors.length; i++)
                {
                    err += "<li>"+response.errors[i]+"</li>";
                }
                err +="</ul>";
                notice('error', '{{__('global.error_update')}}', err);
            }
        }
    });
});

</script>
