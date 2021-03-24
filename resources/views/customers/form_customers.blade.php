<div class="form-heading mt-2 ms-2 me-2">{{ __('global.detail') }}</div>
<form method="post" id="cus_form" class="ms-2 me-2" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="cus_action" value="{{ isset($data->id) ? 'Update':'Add' }}"/>
    <input type="hidden" name="_method" id="cus_method" value="PUT">
    <div class="row">
        <label class="col-2">{{__('customers.fields.account_number')}}</label>
        <div class="col-4">
            <input type="text" name="account_number" id="account_number" class="form-control form-control-sm" value="{{ $data->account_number ?? '' }}" required>
        </div>
        <label class="col-2">{{__('customers.fields.description')}}</label>
        <div class="col-4">
            <input type="text" name="description" id="description" class="form-control form-control-sm" value="{{ $data->description ?? '' }}" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col"><div class="ms-3"><b>{{__('customers.fields.physical_address')}}</b></div></div>
        <div class="col"><div class="ms-3"><b>{{__('customers.fields.delivery_address')}}</b></div></div>
    </div>
    <div class="row mb-2">
        <label class="col-2">{{__('customers.fields.country')}}</label>
        <div class="col-4">
            <select name="physical_country" id="physical_country" class="form-select country" onchange="updZone('physical_province', this.value)"></select>
        </div>
        <label class="col-2">{{__('customers.fields.country')}}</label>
        <div class="col-4">
            <select name="delivery_country" id="delivery_country" class="form-select country" onchange="updZone('delivery_province', this.value)"></select>
        </div>
    </div>
    <div class="row mb-2">
        <label class="col-2">{{__('customers.fields.province')}}</label>
        <div class="col-4">
            <select name="physical_province" id="physical_province" class="form-select"></select>
        </div>
        <label class="col-2">{{__('customers.fields.province')}}</label>
        <div class="col-4">
            <select name="delivery_province" id="delivery_province" class="form-select"></select>
        </div>
    </div>
    <div class="row mb-2">
        <label class="col-2">{{__('customers.fields.physical_address')}}</label>
        <div class="col-4">
            <input type="text" name="physical_address1" id="physical_address1" class="form-control form-control-sm" value="{{ $data->physical_address1 ?? '' }}"/>
        </div>
        <label class="col-2">{{__('customers.fields.delivery_address')}}</label>
        <div class="col-4">
            <input type="text" name="delivery_address1" id="delivery_address1" class="form-control form-control-sm" value="{{ $data->delivery_address1 ?? '' }}" >
        </div>
    </div>
    <div class="row mb-2">
        <label class="col-2"></label>
        <div class="col-4">
            <input type="text" name="physical_address2" id="physical_address2" class="form-control form-control-sm" value="{{ $data->physical_address2 ?? '' }}"/>
        </div>
        <label class="col-2"></label>
        <div class="col-4">
            <input type="text" name="delivery_address2" id="delivery_address2" class="form-control form-control-sm" value="{{ $data->delivery_address2 ?? '' }}" >
        </div>
    </div>
    <div class="row mb-2">
        <label class="col-2">{{__('customers.fields.suburb')}}</label>
        <div class="col-4">
            <input type="text" name="physical_suburb" id="physical_suburb" class="form-control form-control-sm" value="{{ $data->physical_suburb ?? '' }}"/>
        </div>
        <label class="col-2">{{__('customers.fields.suburb')}}</label>
        <div class="col-4">
            <input type="text" name="delivery_suburb" id="delivery_suburb" class="form-control form-control-sm" value="{{ $data->delivery_suburb ?? '' }}" >
        </div>
    </div>
    <div class="row mb-2">
        <label class="col-2">{{__('customers.fields.city')}}</label>
        <div class="col-4">
            <input type="text" name="physical_city" id="physical_city" class="form-control form-control-sm" value="{{ $data->physical_city ?? '' }}"/>
        </div>
        <label class="col-2">{{__('customers.fields.city')}}</label>
        <div class="col-4">
            <input type="text" name="delivery_city" id="delivery_city" class="form-control form-control-sm" value="{{ $data->delivery_city ?? '' }}" >
        </div>
    </div>
    <div class="row mb-2">
        <label class="col-2">{{__('customers.fields.code')}}</label>
        <div class="col-1">
            <input type="text" name="physical_code" id="physical_code" class="form-control form-control-sm" value="{{ $data->physical_code ?? '' }}"/>
        </div>
        <div class="col-3"></div>
        <label class="col-2">{{__('customers.fields.code')}}</label>
        <div class="col-1">
            <input type="text" name="delivery_code" id="delivery_code" class="form-control form-control-sm" value="{{ $data->delivery_code ?? '' }}" >
        </div>
    </div>
    <div class="row mb-2">
        <label class="col-2">{{__('customers.fields.category')}}</label>
        <div class="col-2">
            <input type="text" name="category" id="category" class="form-control form-control-sm" value="{{ $data->category ?? '' }}">
        </div>
        <label class="col-2">{{__('customers.fields.contact_person')}}</label>
        <div class="col-2">
            <input type="text" name="contact_person" id="contact_person" class="form-control form-control-sm" value="{{ $data->contact_person ?? '' }}" required>
        </div>
        <label class="col-2">{{__('customers.fields.telephone')}}</label>
        <div class="col-2">
            <input type="text" name="telephone" id="telephone" class="form-control form-control-sm" value="{{ $data->telephone ?? '' }}">
        </div>
    </div><div class="row mb-2">
        <label class="col-2">{{__('customers.fields.fax')}}</label>
        <div class="col-2">
            <input type="text" name="fax" id="fax" class="form-control form-control-sm" value="{{ $data->fax ?? '' }}">
        </div>
        <label class="col-2">{{__('customers.fields.mobile_phone')}}</label>
        <div class="col-2">
            <input type="text" name="mobile_phone" id="mobile_phone" class="form-control form-control-sm" value="{{ $data->mobile_phone ?? '' }}">
        </div>
        <label class="col-2">{{__('customers.fields.email')}}</label>
        <div class="col-2">
            <input type="email" name="email" id="email" class="form-control form-control-sm" value="{{ $data->email ?? '' }}" required>
        </div>
    </div><div class="row mb-2">
        <label class="col-2">{{__('customers.fields.credit_limit')}}</label>
        <div class="col-2">
            <input type="text" name="credit_limit" id="credit_limit" class="form-control form-control-sm" value="{{ $data->credit_limit ?? '' }}">
        </div>
        <label class="col-2">{{__('customers.fields.current_balance')}}</label>
        <div class="col-2">
            <input type="text" name="current_balance" id="current_balance" class="form-control form-control-sm" value="{{ $data->current_balance ?? '' }}">
        </div>
        <label class="col-2">{{__('customers.fields.currency_code')}}</label>
        <div class="col-2">
            <select name="currency_code" id="currency_code" class="form-select">
                @foreach ($currencies as $k=>$v)
                <option value="{{ $k }}" @if(isset($data->currency_code) && $data->currency_code==$k) selected @endif>{{ $k }} - {{ $v }}</option>
                @endforeach
            </select>
        </div>
    </div><div class="row mb-2">
        <label class="col-2">{{__('customers.fields.payment_terms')}}</label>
        <div class="col-2">
            <select name="payment_terms" id="payment_terms" class="form-select" required>
                @foreach (__('accounting_lookup.payment_terms') as $k=>$v)
                <option value="{{ $k }}" @if(isset($data->payment_terms) && $data->payment_terms==$k) selected @endif>{{ $v }}</option>
                @endforeach
            </select>
        </div>
        <label class="col-2">{{__('customers.fields.is_open_item')}}</label>
        <div class="col-2">
            <div class="form-check">
                <input type="checkbox" name="is_open_item" id="is_open_item" class="form-check-input" @if(isset($data->is_open_item) && $data->is_open_item==1) checked @endif>
            </div>
        </div>
        <label class="col-2">{{__('customers.fields.delivery_group_id')}}</label>
        <div class="col-2">
            <select name="delivery_group_id" id="delivery_group_id" class="form-select">

            </select>
        </div>
    </div><div class="row mb-2">
        <label class="col-2">{{__('customers.fields.vat_reference')}}</label>
        <div class="col-2">
            <input type="text" name="vat_reference" id="vat_reference" class="form-control form-control-sm" value="{{ $data->vat_reference ?? '' }}">
        </div>

        <label class="col-2">{{__('customers.fields.default_tax')}}</label>
        <div class="col-2">
            <select name="default_tax" id="default_tax" class="form-select">
                @foreach (__('accounting_lookup.tax_types') as $k=>$v)
                <option value="{{ $k }}" @if(isset($data->default_tax) && $data->default_tax==$k) selected @endif>{{ $v['trans'] }}</option>
                @endforeach
            </select>
        </div>
        <label class="col-2">{{__('customers.fields.accept_electronic_document')}}</label>
        <div class="col-2">
            <div class="form-check">
                <input type="checkbox" name="accept_electronic_document" id="accept_electronic_document" class="form-check-input" @if(isset($data->accept_electronic_document) &&$data->accept_electronic_document==1) checked @endif>
            </div>
        </div>
    </div><div class="row mb-2">
        <label class="col-2">{{__('customers.fields.documents_contact')}}</label>
        <div class="col-2">
            <input type="text" name="documents_contact" id="documents_contact" class="form-control form-control-sm" value="{{ $data->documents_contact ?? '' }}">
        </div>

        <label class="col-2">{{__('customers.fields.documents_email')}}</label>
        <div class="col-2">
            <input type="email" name="documents_email" id="documents_email" class="form-control form-control-sm" value="{{ $data->documents_email ?? '' }}">
        </div>
        <label class="col-2">{{__('customers.fields.price_list')}}</label>
        <div class="col-2">
            <select name="price_list" id="price_list" class="form-select">
                @foreach (__('inventory_prices.price_list') as $k=>$v)
                    <option value="{{ $k }}" @if(isset($data->price_list) && $data->price_list==$k) selected @endif>{{ $v }}</option>
                @endforeach
            </select>
        </div>
    </div><div class="row mb-2">
        <label class="col-2">{{__('customers.fields.sales_person_id')}}</label>
        <div class="col-2">
            <select name="sales_person_id" id="sales_person_id" class="form-select">
                <option value="0">{{ __('global.company') }}</option>
            </select>
        </div>
        <label class="col-2">{{__('customers.fields.discount')}}</label>
        <div class="col-2">
            <input type="text" name="discount" id="discount" class="form-control form-control-sm" value="{{ $data->discount ?? '' }}">
        </div>
        <label class="col-2">{{__('customers.fields.password')}}</label>
        <div class="col-2">
            <input type="text" name="password" id="password" class="form-control form-control-sm">
        </div>
    </div><div class="row mb-2">
        <label class="col-2">{{__('customers.fields.statement_contact')}}</label>
        <div class="col-2">
            <input type="text" name="statement_contact" id="statement_contact" class="form-control form-control-sm" value="{{ $data->statement_contact ?? '' }}">
        </div>
        <label class="col-2">{{__('customers.fields.statement_email')}}</label>
        <div class="col-2">
            <input type="email" name="statement_email" id="statement_email" class="form-control form-control-sm" value="{{ $data->statement_email ?? '' }}">
        </div>
        <label class="col-2">{{__('customers.fields.is_active')}}</label>
        <div class="col-2">
            <div class="form-check">
                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" @if(isset($data->is_active) && $data->is_active==1) checked @endif>
            </div>
        </div>
    </div><div class="row mb-2">
        <label class="col-2">{{__('customers.fields.statement_message')}}</label>
        <div class="col-10">
            <select name="statement_message" id="statement_message" class="form-select"></select>
        </div>
    </div>
    <div class="modal-footer">
        <input type="submit" class="btn btn-outline-primary btn-sm" value="{{ __('global.save') }}">
    </div>
</form>
<script>
    $(function(){

    });


$('#currency_code').select2();
$('#cus_form').on('submit', function(e){
    e.preventDefault();
    let action = $('#cus_action').val();
    $('#loadImg').show();
    if(action === 'Add')
    {
        $('#cus_method').val('');
        $.ajax({
            url: "/customers/customers",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            success: function (response) {
                if(response.success){
                    notice('success', '{{trans('global.record_added')}}');
                    getDetail(response.success);
                }else{
                    let err='<ul class="text-start">';
                    for(let i=0; i<response.length; i++)
                    {
                        err += "<li>"+response[i]+"</li>";
                    }
                    err +="</ul>";
                    notice('error', '{{trans('global.error_add')}}', err);
                }
            }
        });
    }else{

        let id = $('#customer_id').val();
        $.ajax({
            url: "/customers/customers/"+id,
            method:'POST',
            data: new FormData(this),
            processData:false,
            contentType: false,
            cache: false,
            dataType: 'JSON',
            success: function(response)
            {
                if(response.success){
                    $('#C'+id).removeClass('list-group-item-danger');
                    $('#C'+id).removeClass('list-group-item-success');
                    $('#C'+id).html($('#account_number').val()+': '+$('#description').val());                     
                    if(parseFloat(response.success.is_active)===1){                            
                        $('#C'+id).addClass('list-group-item-success');
                    }else{
                        $('#C'+id).addClass('list-group-item-danger');
                    }        
                    notice('success', '{{__("global.record_updated")}}');
                }else{
                    let err='<ul class="text-start">';
                    for(let i=0; i<response.error.length; i++)
                    {
                        err += "<li>"+response.error[i]+"</li>";
                    }
                    err +="</ul>";
                    notice('error', '{{__("global.error_update")}}', err);
                }
            }
        }); 
    }
    $('#loadImg').hide();
});

function updZone(element, id, prov=''){
    $.ajax({
        url: "/search/zone/"+id,
        method:'POST',
        // processData:false,
        // contentType: false,
        cache: true,
        dataType: 'JSON',
        success: function(items)
        {
            $.each(items, function (i, item) {
                $('#'+element).append($('<option>', {
                    value: item.id,
                    text : item.text
                }));
            });
            //alert(prov);
            if(prov > '')
            {
                $('#'+element).val(prov);
            }
        }
    });
}
function updCountry(element, val){
    $.ajax({
        url: "/search/country/"+val,
        method:'POST',
        // processData:false,
        // contentType: false,
        cache: true,
        dataType: 'JSON',
        success: function(items)
        {
            $.each(items, function (i, item) {
                $('#'+element).append($('<option>', {
                    value: item.id,
                    text : item.text
                }));
            });
        }
    });
}

$('.country').select2({
    minimumInputLength: 3,
    ajax: {
        url: '/search/country',
        method: 'POST',
        data: function (params) {
            var query = {
                search: params.term,
            };
            return query;
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
    }
});
@if($data->physical_country>0)
        updZone('physical_province', {{ $data->physical_country }}, {{ $data->physical_province }});
        updCountry('physical_country', {{ $data->physical_country }});
        updZone('delivery_province', {{ $data->delivery_country }}, {{ $data->delivery_province }});
        updCountry('delivery_country', {{ $data->delivery_country }});
        @endif
</script>
