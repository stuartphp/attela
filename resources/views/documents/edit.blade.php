@extends('layouts.iframe')
@section('content')
@foreach(__('accounting_lookup.tax_types') as $k=>$v)
    <input type="hidden" id="tax_{{$k}}" value="{{$v['trans']}}"/>
@endforeach
<form action="/documents/{{ $url }}/{{ $data->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="_method" value="PUT"/>
    <div class="card shadow mb-4" style="background-color: {{ $color }}">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6"><a href="/documents/{{ $url }}">{{ __('documents.documents.'.$data->document_type) }}</a> / Edit : {{ $data->document_number }}</a></div>
                <div class="col-md-6 text-right">

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3"><address>
                        <strong>Billed To:</strong><span class="pull-right"><i class="fa fa-edit mfs-sm-1" onclick="addressEdit('billing')"></i> </span><br>
                        <div id="billing">{{$data->entity_name}}<br>{!! nl2br($data->physical_address) !!}</div>
                    </address></div>
                <div class="col-md-3"><address>
                        <strong>Shipped To:</strong><span class="pull-right"><i class="fa fa-edit mfs-sm-1" onclick="addressEdit('delivery')"></i> </span><br>
                        <div id="delivery">{!! nl2br($data->delivery_address) !!}</div>
                    </address></div>
                <div class="col-md-6">
                    <table style="width: 100%; table-layout: fixed; overflow-wrap: break-word;">
                        <tr>
                            <td>Date:</td>
                            <td><input type="text" class="form-control date form-control-sm" name="action_date" id="action_date" value="{{$data->action_date}}"></td>
                            <td>AccountNr.:</td>
                            <td>{{$data->account_number}}</td>
                        </tr>
                        <tr>
                            <td>DeliveryDate</td>
                            <td><input type="text" class="form-control date form-control-sm" name="expire_delivery" id="expire_delivery" value="{{$data->expire_delivery}}"></td>

                            <td>SalesCode:</td>
                            <td>{{$data->sales_code}}</td>
                        </tr>
                        <tr>
                            <td>ReferenceNr.:</td>
                            <td>@if($data->reference_number==null) <input type="text" class="form-control form-control-sm" id="reference_number" name="reference_number"> @else {{$data->reference_number}} @endif</td>
                            <td>Terms:</td>
                            <td>{{__('accounting_lookup.payment_terms.'.$entity->payment_terms)}}</td>
                        </tr>
                        <tr>
                            <td>CreditLimit.:</td>
                            <td>{{number_format($entity->credit_limit, 0, '.', ' ')}}</td>
                            <td>Balance:</td>
                            <td>{{isset($entity->current_balance)?number_format($entity->current_balance, 0, '.', ' '):0}}</td>
                        </tr>
                        <tr>
                            <td>Available:</td>
                            <td>{{isset($entity->current_balance)?number_format(($entity->credit_limit - $entity->current_balance), 0, '.', ' '):0}}</td>
                            <td colspan="2">@if(in_array('Current', $stores)) <select name="ledger" id="ledger-search"></select> @endif</td>
                        </tr>

                    </table>

                </div>
            </div>
            <div class="row pb-1">
                <div class="col-sm-4">
                    <select id="store" class="form-control form-control-sm"  aria-describedby="basic-addon1">
                        @foreach($stores as $k=>$v)
                            <option value="{{$k}}">{{$v}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-8">
                    <select class="form-control form-control-sm" id="inventory_item_select"  aria-describedby="basic-addon2" placeholder="{{ __('global.pleaseSelect') }}"></select>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-1">{{ __('documents.doc.code') }}</th>
                                <th class="col-4">{{ __('documents.doc.description') }}</th>
                                <th class="col-2">{{ __('documents.doc.options') }}</th>
                                <th class="col-1">{{ __('documents.doc.unit') }}</th>
                                <th class="col-1">{{ __('documents.doc.quantity') }}</th>
                                <th class="col-1">{{ __('documents.doc.price_excl') }}</th>
                                <th class="col-1">{{ __('documents.doc.vat') }}</th>
                                <th class="col-1">{{ __('documents.doc.discount') }}</th>
                            </tr>
                        </thead>
                        <tbody id="docBody">
                            @foreach ($items as $item)
                            <tr id="r{{$item->item_id}}">
                                <input type="hidden" name="item_id[]" value="{{$item->item_id}}">
                                <input type="hidden" name="store[]" value="{{$item->store_id}}">
                                <input type="hidden" name="item_code[]" value="{{$item->item_code}}">
                                <input type="hidden" name="project[]" value="{{$item->project}}">
                                <input type="hidden" name="service[]" value="{{$item->is_service}}">
                                <input type="hidden" name="unit_price[]" value="{{$item->unit_price}}">
                                {{-- <input type="hidden" name="disc[]" id="disc{{$item->item_id}}" value="{{$item->discount_perc}}"> --}}

                                <td>{{$item->item_code}}</td>
                                <td><input type="text" name="item_description[]" value="{{$item->item_description}}" class="form-control form-control-sm"></td>
                                <td><input type="text" name="options[]" value="{{$item->options}}" class="form-control form-control-sm"></td>
                                <td><input type="text" name="unit[]" value="{{$item->unit}}" class="form-control form-control-sm"></td>
                                <td><input type="text" name="qty[]" id="qty{{$item->item_id}}" onchange="doCalculation()" class="quantity form-control form-control-sm" value="{{$item->quantity}}"> </td>
                                <td class="text-right"><input type="text" name="price[]" id="price{{$item->item_id}}" value="{{$item->price_excl}}" class="price form-control form-control-sm"></td>
                                <td style="width:120px">
                                    <select name="tax_type[]" class="form-select tax" onchange="doCalculation()">
                                        @foreach(__('accounting_lookup.tax_types') as $k=>$v)
                                        <option value="{{ $k.'~'.$v['impact'] }}" @if($k==$item->tax_type) selected @endif>{{ $v['trans'] }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" name="disc[]" id="disc{{$item->item_id}}" onchange="doCalculation()" class="discount form-control form-control-sm" value="{{$item->discount_perc}}"></td>
                                <td><a href="#" onclick="delThis('{{$item->item_id}}')"><i class="bi bi-dash"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <!-- /.box-footer-->
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-1">Nett Price</div>
            <div class="col-sm-1"><span class="pull-right" id="nett_price">0.00</span></div>
            <div class="col-sm-1">Discount</div>
            <div class="col-sm-1"><span class="pull-right" id="discount">0.00</span></div>
            <div class="col-sm-1">Exclusive</div>
            <div class="col-sm-1"><span class="pull-right" id="exclusive">0.00</span></div>
            <div class="col-sm-1">Tax</div>
            <div class="col-sm-1"><span class="pull-right" id="doc_tax">0.00</span></div>
            <div class="col-sm-2"></div>
            <div class="col-sm-1">Total Due:</div>
            <div class="col-sm-1"><span class="pull-right" id="doc_total">0.00</span></div>
        </div>
        <div class="text-end"><input type="submit" class="btn btn-danger btn-sm" id="saveBtn" value="Save"></div>
    </div>
    <input type="hidden" id="t_nett_price" name="nett_price">
    <input type="hidden" id="t_discount" name="discount">
    <input type="hidden" id="t_exclusive" name="exclusive">
    <input type="hidden" id="t_doc_tax" name="doc_tax">
    <input type="hidden" id="t_doc_total" name="doc_total">
</div>
</form>
@endsection
@section('scripts')
<?php
$tax='';
foreach(__('accounting_lookup.tax_types') as $k=>$v)
{
    $impact = $v['impact'];//__('accounting_lookup.tax_types.'.$k.'.impact');
    $trans=$v['trans'];
    $sel='';
    if($k==$entity->default_tax)
    {
        $sel='selected';
    }
    $tax .='<option value="'.$k.'~'.$impact.'" '.$sel.'>'.$trans.'</option>';
}

?>
<script>
    let tax_type_options = window.tax_type_options || '<?php echo $tax;?>' ;
@if(in_array('Current', $stores))
<?php
    $random = 'a'.substr(md5(mt_rand()), 0, 7);
    echo 'let '.$random.' = 1;';
?>

function createBlankItem() {

    let line = '<tr id="ra' + {{$random}} + '">\n' +
        '<input type="hidden" name="item_id[]" value="blank">' +
        '<input type="hidden" name="store[]" value="0">' +
        '<input type="hidden" name="project[]" value="">' +
        '<input type="hidden" name="service[]" value="0">' +
        '<input type="hidden" name="unit_price[]" value="0">' +
        '            <td><input type="text" name="item_code[]" value="" class="form-control"></td>\n' +
        '            <td><input type="text" name="item_description[]" value="" class="form-control"></td>\n' +
        '            <td"><input type="text" name="options[]" value="" class="form-control"></td>\n' +
        '            <td><input type="text" name="unit[]" value="" class="form-control"></td>\n' +
        '            <td><input type="text" name="qty[]" id="qty' + {{$random}} + '" onchange="doCalculation()" class="quantity form-control" value="1"> </td>\n' +
        '            <td class="text-right"><input type="text" name="price[]" id="price' + {{$random}} + '" value="1" class="price form-control" onchange="doCalculation()"></td>\n' +
        '<td style="width:120px"><select class="form-select tax" name="tax_type[]" onchange="doCalculation()">'+tax_type_options+'</select></td>'+
        '            <td><input type="text" name="disc[]" id="disc' + {{$random}} + '" onchange="doCalculation()" class="discount form-control" value=""> <div class="input-group-append">&nbsp;<a href="#" onclick="delThis(\'a'+{{$random}}+'\')" title="{{__('global.delete')}}"><i class="bi bi-dash"></i></a></div></td>\n' +
        '        </tr>';
    {{$random}}++;
    $('#docBody').before(line);
    return false;
}
@endif
function PopDoc() {

let item = $('#inventory_item_select').val().split('~');

let element =  document.getElementById('r'+item[0]);

if (typeof(element) != 'undefined' && element != null)
{
    // Get current qty
    qty = parseFloat($('#qty'+item[0]).val())+1;
    $('#qty'+item[0]).val(qty);
    doCalculation();

}else {
    let qty = 1;
    let line = '<tr id="r' + item[0] + '">\n' +
        '<input type="hidden" name="item_id[]" value="' + item[0] + '">' +
        '<input type="hidden" name="store[]" value="' + $('#store').val() + '">' +
        '<input type="hidden" name="item_code[]" value="' + item[1] + '">' +
        '<input type="hidden" name="project[]" value="">' +
        '<input type="hidden" name="service[]" value="' + item[7] + '">' +
        '<input type="hidden" name="unit_price[]" value="' + item[5] + '">' +
        '            <td>' + item[1] + '</td>\n' +
        '            <td><input type="text" name="item_description[]" value="' + item[2] + '" class="form-control form-control-sm"></td>\n' +
        '            <td><input type="text" name="options[]" value="" class="form-control form-control-sm"></td>\n' +
        '            <td><input type="text" name="unit[]" value="' + item[3] + '" class="form-control form-control-sm"></td>\n' +
        '            <td><input type="text" name="qty[]" id="qty' + item[0] + '" onchange="doCalculation()" class="quantity form-control form-control-sm" value="' + qty + '"> </td>\n' +
        '            <td class="text-right"><input type="text" name="price[]" id="price' + item[0] + '" value="' + item[4] + '" class="price form-control form-control-sm" onchange="doCalculation()"></td>\n' +
        '<td style="width:120px"><select class="form-select tax" name="tax_type[]" onchange="doCalculation()">'+tax_type_options+'</select></td>'+
            '            <td><div class="input-group"><input type="text" name="disc[]" id="disc' + item[0] + '" onchange="doCalculation()" class="discount form-control form-control-sm" value=""> <div class="input-group-append">&nbsp;<a href="#" onclick="delThis(\'' + item[0] + '\')" title="{{__('global.delete')}}"><i class="bi bi-dash text-danger"></i></a></div></td>\n' +
        '        </tr>';

    $('#docBody').before(line);
    doCalculation();

}
}

function delThis(i) {
$('#r'+i+'').remove();
doCalculation();
}
function doCalculation()
{
    let price = [];
    let qty =[];
    let disc = [];
    let tax =[];
    $('.price').each(function () {
        price.push($(this).val());
    });
    $('.quantity').each(function () {
        qty.push($(this).val());
    });
    $('.discount').each(function () {
        disc.push($(this).val());
    });
    $('.tax').each(function () {
        let v = $(this).val().split('~');

        if(v[1]>0)
        {
            tax.push({{config(session()->get('company_id').'.vat_percentage')}});
        }else{
            tax.push(0);
        }
    });

    let nett_price=0;
    let discount=0;
    let exclusive =0;
    let total_tax=0;

    for(let i=0; i<price.length; i++)
    {
        let p = parseFloat(price[i]);
        let q = parseFloat(qty[i]);
        let d = parseFloat(disc[i]);
        let t = parseFloat(tax[i]);
        nett_price = nett_price+(p*q);
        if(d > 0)
        {
            p = p-d;
            discount = discount+(d*q);
        }
        exclusive = exclusive+(p*q);
        total_tax= total_tax+((p*q)*t)/100;
    }

    total = total_tax+exclusive;

    $('#nett_price').html(accounting.formatMoney(nett_price, 'R ', 2, " ", ","));
    $('#discount').html(accounting.formatMoney(discount, 'R ', 2, " ", ","));
    $('#doc_tax').html(accounting.formatMoney(total_tax, 'R ', 2, " ", ","));
    $('#exclusive').html(accounting.formatMoney(exclusive, 'R ', 2, " ", ","));
    $('#doc_total').html(accounting.formatMoney(total, 'R ', 2, " ", ","));
    $('#t_nett_price').val(nett_price);
    $('#t_discount').val(discount);
    $('#t_doc_tax').val(total_tax);
    $('#t_exclusive').val(exclusive);
    $('#t_doc_total').val(total);
}
$('#inventory_item_select').select2({
    placeholder: "{{__('global.pleaseSelect').' '.__('inventory_items.title')}}",
    ajax: {
        url: '/search/document-items',
        method: 'POST',
        dataType: 'json',
        data: function (params) {
            var query = {
                search: params.term,
                price_list:@if(isset($entity->price_list))'{{$entity->price_list}}'@else 'supplier'@endif,
                store: @if(isset($entity->price_list))$('#store').val() @else {{$data->entity_id}} @endif,
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
$('#inventory_item_select').on('select2:select', function (e) {
    PopDoc();
});
$( window ).on( "load", doCalculation() );
</script>
@endsection
