@extends('layouts.admin')
@section('title', __('global.menu.documents.title'))
@section('content')
<div id="mySidenav" class="sidenav">
    <div class="head mb-1 ms-2 me-2">
        {{ __('documents.title') }}<span style="float:right"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></span>
    </div>

    <div class="list-group ms-3 me-3">
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
<div>
    <livewire:documents.document-list/>
</div>



@endsection
@section('scripts')
<script>
    function openNav() {
  document.getElementById("mySidenav").style.width = ""+sideMenu+"px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
$(function(){
    getDetail('all');
});

function getDetail(url)
{
    toggleImg();
    closeNav();
    $('#result').prop('src', '/documents/'+url);
    toggleImg();
}


</script>
@endsection
