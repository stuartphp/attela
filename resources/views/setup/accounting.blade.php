
@extends('layouts.iframe')
@section('content')
<form method="post" id="set_acc_form" action="@if(isset($data->id)){{ route('accounting.update', $data->id) }}@else {{ route('accounting.store') }} @endif" enctype="multipart/form-data">
@csrf
<input type="hidden" id="action"/>
<input type="hidden" name="_method" id="method" @if(isset($data->id)) value="PUT" @endif>
<div class="card shadow mb-4">
    <div class="card-header">{{ __('setup_accounting.title') }} </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
<div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.trade_classification')}}</label>
            <div class="col-9">
                <select name="trade_classification" id="trade_classification" class="form-select select">
                    @foreach (\App\Models\SarsTradeClassification::pluck('description', 'id')->toArray() as $k=>$v)
                    <option value="{{ $k }}" @if(isset($data->trade_classification) && $data->trade_classification==$k) selected @endif>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.retained_earnings')}}</label>
            <div class="col-9">
                <select name="retained_earnings" id="retained_earnings" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->retained_earnings) && $data->retained_earnings==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.profit_loss_year')}}</label>
            <div class="col-9">
                <select name="profit_loss_year" id="profit_loss_year" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->profit_loss_year) && $data->profit_loss_year==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.exchange_variances_account')}}</label>
            <div class="col-9">
                <select name="exchange_variances_account" id="exchange_variances_account" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->exchange_variances_account) && $data->exchange_variances_account==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.bank_charges')}}</label>
            <div class="col-9">
                <select name="bank_charges" id="bank_charges" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->bank_charges) && $data->bank_charges==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.sales_account')}}</label>
            <div class="col-9">
                <select name="sales_account" id="sales_account" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->sales_account) && $data->sales_account==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.sales_discount_account')}}</label>
            <div class="col-9">
                <select name="sales_discount_account" id="sales_discount_account" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->sales_discount_account) && $data->sales_discount_account==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.purchase_discount_account')}}</label>
            <div class="col-9">
                <select name="purchase_discount_account" id="purchase_discount_account" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->purchase_discount_account) && $data->purchase_discount_account==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.debtor_control_account')}}</label>
            <div class="col-9">
                <select name="debtor_control_account" id="debtor_control_account" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->debtor_control_account) && $data->debtor_control_account==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.bad_debt_account')}}</label>
            <div class="col-9">
                <select name="bad_debt_account" id="bad_debt_account" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->bad_debt_account) && $data->bad_debt_account==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.bad_debt_recovered_account')}}</label>
            <div class="col-9">
                <select name="bad_debt_recovered_account" id="bad_debt_recovered_account" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->bad_debt_recovered_account) && $data->bad_debt_recovered_account==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.supplier_control_account')}}</label>
            <div class="col-9">
                <select name="supplier_control_account" id="supplier_control_account" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->supplier_control_account) && $data->supplier_control_account==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.inventory_account')}}</label>
            <div class="col-9">
                <select name="inventory_account" id="inventory_account" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->inventory_account) && $data->inventory_account==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
            </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.cogs_account')}}</label>
            <div class="col-9">
                <select name="cogs_account" id="cogs_account" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->cogs_account) && $data->cogs_account==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.vat_control_account')}}</label>
            <div class="col-9">
                <select name="vat_control_account" id="vat_control_account" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->vat_control_account) && $data->vat_control_account==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.vat_output')}}</label>
            <div class="col-9">
                <select name="vat_output" id="vat_output" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->vat_output) && $data->vat_output==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.vat_input')}}</label>
            <div class="col-9">
                <select name="vat_input" id="vat_input" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->vat_input) && $data->vat_input==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.vat_percentage')}}</label>
            <div class="col-9">
                <select name="vat_percentage" id="vat_percentage" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->vat_percentage) && $data->vat_percentage==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.inventory_adjustments_account')}}</label>
            <div class="col-9">
                <select name="inventory_adjustments_account" id="inventory_adjustments_account" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->inventory_adjustments_account) && $data->inventory_adjustments_account==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.rounding_account')}}</label>
            <div class="col-9">
                <select name="rounding_account" id="rounding_account" class="form-select select">
                    @foreach ($ledgers as $k=>$v)
                        <option value="{{ $k }}" @if(isset($data->rounding_account) && $data->rounding_account==$k) selected @endif>{{substr($k, 0,4).'/'.substr($k,4,3).' - '.$v}}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.round_to_nearest')}}</label>
            <div class="col-9">
                <input type="text" name="round_to_nearest" id="round_to_nearest" class="form-control form-control-sm" value="{{ isset($data->round_to_nearest) ? $data->round_to_nearest :'' }}">
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.depreciation_period')}}</label>
            <div class="col-9">
                <input type="number" name="depreciation_period" id="depreciation_period" class="form-control form-control-sm" value="{{ isset($data->depreciation_period) ? $data->depreciation_period :'' }}">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.default_credit_limit')}}</label>
            <div class="col-9">
                <input type="text" name="default_credit_limit" id="default_credit_limit" class="form-control form-control-sm" value="{{ isset($data->default_credit_limit) ? $data->default_credit_limit :'' }}">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.financial_year')}}</label>
            <div class="col-9">
                @php
                            $current = date('Y');
                        $begin = $current-10;
                        @endphp
                        <select class="select form-control form-control-sm" id="financial_year" name="financial_year">
                            @for($x=1; $x<11; $x++)
                                @php $begin = $begin+1;
                                $year =($begin+1).'/'.($begin+2);@endphp
                                <option value="{{$year}}" @if(isset($data->financial_year) && $data->financial_year==$year) selected @endif>{{$year}}</option>
                            @endfor
                        </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.financial_period')}}</label>
            <div class="col-9">
                <input type="text" name="financial_period" id="financial_period" class="form-control form-control-sm" value="{{ isset($data->financial_period) ? $data->financial_period :'' }}">
            </div>
        </div>
    </div>
            <div class="col-6">

        <div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.quote_valid_days')}}</label>
            <div class="col-9">
                <input type="number" name="quote_valid_days" id="quote_valid_days" class="form-control form-control-sm" value="{{ isset($data->quote_valid_days) ? $data->quote_valid_days :'' }}">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.charge_delivery_cost')}}</label>
            <div class="col-9">
                <select name="charge_delivery_cost" id="charge_delivery_cost" class="form-select select">
                    @foreach (__('global.yesno') as $k=>$v)
                    <option value="{{ $k }}" @if(isset($data->charge_delivery_cost) && $data->charge_delivery_cost==$k) selected @endif>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.dispatch_on_invoice')}}</label>
            <div class="col-9">
                <select name="dispatch_on_invoice" id="dispatch_on_invoice" class="form-select select">
                    @foreach (__('global.yesno') as $k=>$v)
                    <option value="{{ $k }}" @if(isset($data->dispatch_on_invoice) && $data->dispatch_on_invoice==$k) selected @endif>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
        </div>
            <div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.is_vat_registered')}}</label>
            <div class="col-9">
                <select name="is_vat_registered" id="is_vat_registered" class="select">
                    @foreach (__('global.yesno') as $k=>$v)
                    <option value="{{ $k }}" @if(isset($data->is_vat_registered) && $data->is_vat_registered==$k) selected @endif>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.vat_number')}}</label>
            <div class="col-9">
                <input type="text" name="vat_number" id="vat_number" class="form-control form-control-sm" value="{{ isset($data->vat_number) ? $data->vat_number :'' }}">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.tax_number')}}</label>
            <div class="col-9">
                <input type="text" name="tax_number" id="tax_number" class="form-control form-control-sm" value="{{ isset($data->tax_number) ? $data->tax_number :'' }}">
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.uif_number')}}</label>
            <div class="col-9">
                <input type="text" name="uif_number" id="uif_number" class="form-control form-control-sm" value="{{ isset($data->uif_number) ? $data->uif_number :'' }}">
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.sdl_number')}}</label>
            <div class="col-9">
                <input type="text" name="sdl_number" id="sdl_number" class="form-control form-control-sm" value="{{ isset($data->sdl_number) ? $data->sdl_number :'' }}">
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.paye_number')}}</label>
            <div class="col-9">
                <input type="text" name="paye_number" id="paye_number" class="form-control form-control-sm" value="{{ isset($data->paye_number) ? $data->paye_number :'' }}">
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.import_number')}}</label>
            <div class="col-9">
                <input type="text" name="import_number" id="import_number" class="form-control form-control-sm" value="{{ isset($data->import_number) ? $data->import_number :'' }}">
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.statement_message')}}</label>
            <div class="col-9">
                <textarea name="statement_message" id="statement_message" class="form-control form-control-sm">@if(isset($data->statement_message)){!! $data->statement_message !!}@endif</textarea>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.tax_invoice_message')}}</label>
            <div class="col-9">
                <textarea name="tax_invoice_message" id="tax_invoice_message" class="form-control form-control-sm"></textarea>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.sales_order_message')}}</label>
            <div class="col-9">
                <textarea name="sales_order_message" id="sales_order_message" class="form-control form-control-sm"></textarea>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.quotation_message')}}</label>
            <div class="col-9">
                <textarea name="quotation_message" id="quotation_message" class="form-control form-control-sm"></textarea>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.receipt_message')}}</label>
            <div class="col-9">
                <textarea name="receipt_message" id="receipt_message" class="form-control form-control-sm"></textarea>
            </div>
        </div><div class="row mb-2">
            <label class="col-3">{{__('setup_accounting.fields.credit_note_message')}}</label>
            <div class="col-9">
                <textarea name="credit_note_message" id="credit_note_message" class="form-control form-control-sm"></textarea>
            </div>
        </div>
            </div>
        </div>

        </div>

    <div class="modal-footer">
        <input type="submit" class="btn btn-primary btn-sm" value="{{ __('global.save') }}">
    </div>
  </div>

</form>
@endsection
@section('scripts')
<script>
    $('.select').select2();
})
</script>

@endsection
