
<div class="form-heading mt-2 ms-2 me-2">Loans</div>
<form method="post" class="ms-2 me-2" id="loan_form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="action"/>
    <input type="hidden" name="_method" id="method">
    <div class="card">
        <div class="cadr-header"></div>
        <div class="card-body">
            <div class="ml-1">
        <div class="row mb-2">
            <label class="col-2">{{__('employee_loans.fields.reference_number')}}</label>
            <div class="col-2">
                <input type="text" name="reference_number" id="reference_number" class="form-control form-control-sm">
            </div>
            <label class="col-2">{{__('employee_loans.fields.issue_date')}}</label>
            <div class="col-2">
                <input type="text" name="issue_date" id="issue_date" class="form-control date form-control-sm">
            </div>
            <label class="col-2">{{__('employee_loans.fields.start_date')}}</label>
            <div class="col-2">
                <input type="text" name="start_date" id="start_date" class="form-control date form-control-sm">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-2">{{__('employee_loans.fields.end_date')}}</label>
            <div class="col-2">
                <input type="text" name="end_date" id="end_date" class="form-control date form-control-sm">
            </div>
            <label class="col-2">{{__('employee_loans.fields.start_period')}}</label>
            <div class="col-2">
                <select name="start_period" id="start_period" class="form-select">
                    @for ($i = 1; $i < 14; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <label class="col-2">{{__('employee_loans.fields.end_period')}}</label>
            <div class="col-2">
                <select name="end_period" id="end_period" class="form-select">
                    @for ($i = 1; $i < 14; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-2">{{__('employee_loans.fields.total_amount_due')}}</label>
            <div class="col-2">
                <input type="text" name="total_amount_due" id="total_amount_due" class="form-control form-control-sm">
            </div>
            <label class="col-2">{{__('employee_loans.fields.transaction_code')}}</label>
            <div class="col-2">
                <input type="text" name="transaction_code" id="transaction_code" class="form-control form-control-sm" value="8200/020" readonly>
            </div>
            <label class="col-2">{{__('employee_loans.fields.balance')}}</label>
            <div class="col-2">
                <input type="text" name="balance" id="balance" class="form-control form-control-sm">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-2">{{__('employee_loans.fields.interest_on_amount')}}</label>
            <div class="col-2">
                <input type="text" name="interest_on_amount" id="interest_on_amount" class="form-control form-control-sm">
            </div>
            <label class="col-2">{{__('employee_loans.fields.interest_amount')}}</label>
            <div class="col-2">
                <input type="text" name="interest_amount" id="interest_amount" class="form-control form-control-sm">
            </div>
            <label class="col-2">{{__('employee_loans.fields.interest_transaction_code')}}</label>
            <div class="col-2">
                <input type="text" name="interest_transaction_code" id="interest_transaction_code" class="form-control form-control-sm" value="2750/009" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="row mb-2">
                    <label class="col-4">{{__('employee_loans.fields.interest_perc')}}</label>
                    <div class="col-4">
                        <input type="text" name="interest_perc" id="interest_perc" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-4">{{__('employee_loans.fields.paid_up')}}</label>
                    <div class="col-4">
                        <select name="paid_up" id="paid_up" class="form-select">
                            @foreach (__('global.yesno') as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-4">{{__('employee_loans.fields.settlement_date')}}</label>
                    <div class="col-4">
                        <input type="text" name="settlement_date" id="settlement_date" class="form-control date form-control-sm">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row mb-2">
                    <label class="col-4">{{__('employee_loans.fields.settlement_reason')}}</label>
                    <div class="col-8">
                        <textarea name="settlement_reason" id="settlement_reason" class="form-control form-control-sm"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>

    <div class="modal-footer">
        <input type="submit" class="btn btn-primary btn-sm" value="{{ __('global.save') }}">
    </div></div>
</form>
