@extends('layouts.admin')
@section('title', __('global.menu.documents.title'))
@section('content')
<div id="arrow_list_open"><a href="#"><i class="bi bi-caret-right-fill text-warning"></i></a></div>
<div class="split-panel">
    <div class="list-panel">
        <div class="title mb-1">
            {{ __('documents.title') }}<span style="float: right"><a href="#"><i class="bi bi-caret-left-fill text-success" id="arrow_list_close"></i></a></span>
        </div>
        <form action="{{ url('documents/all') }}" method="get">
            <div class="input-group input-group-sm mb-2">
                <input type="text" class="form-control form-control-sm" name="search" placeholder="{{ __('global.search') }}" aria-label="Search" aria-describedby="basic-addon2" @if(isset($search)) value="{{$search}}" @endif>
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm" type="submit">
                    <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="list-group">
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('all')">{{ __('accounting_lookup.documents.all') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('credit-notes')">{{ __('accounting_lookup.documents.credit_note') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('credit-from-suppliers')">{{ __('accounting_lookup.documents.credit_from_supplier') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('credit-to-suppliers')">{{ __('accounting_lookup.documents.credit_to_supplier') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('debit-notes')">{{ __('accounting_lookup.documents.debit_note') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('goods-delivery-notes')">{{ __('accounting_lookup.documents.goods_delivery_note') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('goods-received-notes')">{{ __('accounting_lookup.documents.goods_received_note') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('purchase-orders')">{{ __('accounting_lookup.documents.purchase_order') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('quotations')">{{ __('accounting_lookup.documents.quotation') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('receipts')">{{ __('accounting_lookup.documents.receipts') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('payment-made')">{{ __('accounting_lookup.documents.payment_made') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('return-debits')">{{ __('accounting_lookup.documents.return_debit') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('sales-orders')">{{ __('accounting_lookup.documents.sales_order') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('supplier-invoices')">{{ __('accounting_lookup.documents.supplier_invoice') }}</button>
            <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('tax-invoices')">{{ __('accounting_lookup.documents.tax_invoice') }}</button>
        </div>
    </div>

    <div class="content-panel">
        <div class="ratio ratio-16x9 overflow-auto">
            <iframe id="result" src="" allowfullscreen ></iframe>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
$(function(){
    $('#arrow_list_open').hide();
    getDetail('all');
});
$('#arrow_list_close').on('click', function(){
    $('.list-panel').hide();
    $('#arrow_list_open').show();
});
$('#arrow_list_open').on('click', function(){
    $('#arrow_list_open').hide();
    $('.list-panel').show();
});
$('.list-group-item').on('click', function(){
    $('.list-group-item').removeClass('active');
    $(this).addClass('active');
})
function getDetail(url)
{
    $('#loadImg').show();
    $('#result').prop('src', '/documents/'+url);
    $('#loadImg').hide();
}


</script>
@endsection
