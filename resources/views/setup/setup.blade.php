@extends('layouts.admin')
@section('title', __('global.menu.setup.title'))
@section('css')
<style>
    .list-group-item :hover {
        cursor: pointer;
    }
</style>
@endsection
@section('content')
<div id="arrow_list_open"><a href="#"><i class="bi bi-caret-right"></i></a></div>
<div class="split-panel">
    <div class="list-panel">
        <div class="title">Settings
            <span style="float: right"><a href="#"><i class="bi bi-caret-left" id="arrow_list_close"></i></a></span>
        </div>

        <div class="list-group pt-2">
            @if(count(array_intersect(session()->get('grant'), ['SU','setup_accounting_access']))==1)
                <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('accounting')" >{{ __('setup_accounting.title') }}</button>
            @endif
            @if(count(array_intersect(session()->get('grant'), ['SU','companies_access']))==1)
                <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('companies')" >{{ __('companies.title') }}</button>
            @endif
            @if(count(array_intersect(session()->get('grant'), ['SU','counters_access']))==1)
                <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('counters')" >{{ __('counters.title') }}</button>
            @endif
            @if(count(array_intersect(session()->get('grant'), ['SU','countries_access']))==1)
                <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('countries')" >{{ __('countries.title') }}</button>
            @endif
            @if(count(array_intersect(session()->get('grant'), ['SU','setup_delivery_groups_access']))==1)
                <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('delivery-groups')" >{{ __('setup_delivery_groups.title') }}</button>
            @endif
            @if(count(array_intersect(session()->get('grant'), ['SU','disciplinary_reasons_access']))==1)
                <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('disciplinary-reasons', 1)" >{{ __('disciplinary_reasons.title') }}</button>
            @endif
            @if(count(array_intersect(session()->get('grant'), ['SU','documents_access']))==1)
                <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('documents', 1)" >{{ __('documents.title') }}</button>
            @endif
            @if(count(array_intersect(session()->get('grant'), ['SU','setup_leave_access']))==1)
                <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('leave')" >{{ __('employee_leaves.title') }}</button>
            @endif
            @if(count(array_intersect(session()->get('grant'), ['SU','ledgers_access']))==1)
                <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('ledgers')" >{{ __('ledgers.title') }}</button>
            @endif
            @if(count(array_intersect(session()->get('grant'), ['SU','lookups_access']))==1)
                <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('lookups')" >{{ __('lookups.title') }}</button>
            @endif

            @if(count(array_intersect(session()->get('grant'), ['SU','setup_payment_access']))==1)
                <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('payments')" >{{ __('setup_payment.title') }}</button>
            @endif
            @if(count(array_intersect(session()->get('grant'), ['SU','setup_payment_access']))==1)
                <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('payroll-transaction-codes')" >Transaction Codes</button>
            @endif
            @if(count(array_intersect(session()->get('grant'), ['SU','stores_access']))==1)
                <button type="button" class="list-group-item list-group-item-action" onclick="getDetail('stores')" >{{ __('stores.title') }}</button>
            @endif
        </div>

        <div class="position-relative pt-1">

        </div>
    </div>
    <div class="content-panel">
        <div class="ratio ratio-16x9">
            <iframe id="result" src="" allowfullscreen></iframe>
        </div>
    </div>
</div>
</section>

@endsection
@section('scripts')

<script>
$(function(){
    $('#arrow_list_open').hide();
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
function getDetail(url, iframe='')
{
    $('#result').prop('src', '/setup/'+url)
}

</script>
@endsection
