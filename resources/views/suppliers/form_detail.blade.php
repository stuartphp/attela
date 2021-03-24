<div class="form-heading mt-2 ms-2 me-2">
    <span style="cursor:pointer" onclick="openNav()">{!! isset($data->id) ? '': '&#9776;' !!}</span>
    {{ __('suppliers.title') }} Detail</div>

<form method="post" id="supplier_form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="supplier_action" value="{{ isset($data->id) ? 'Update':'Add' }}"/>
    <input type="hidden" name="_method" id="method">
    <input type="hidden" id="id" value="">
    <input type="hidden" name="company_id" id="company_id" value="{{ session()->get('company_id') }}">
<div class="row ms-2 me-2">
    <div class="col-6"> 
        <div class="mb-2 row">
            <label class="col-md-3">{{__('suppliers.fields.account_number')}}</label>
            <div class="col-md-9">
                <input type="text" name="account_number" id="account_number" class="form-control form-control-sm" value="{{ $data->account_number ?? '' }}">
            </div>
        </div>
        <div class="mb-2 row">
            <label class="col-md-3">{{__('suppliers.fields.postal_address')}}</label>
            <div class="col-md-9">
                <textarea name="postal_address" id="postal_address" class="form-control form-control-sm" style="height: 100px">{!! $data->postal_address ?? '' !!}</textarea>
            </div>
        </div>
        <div class="mb-2 row">
            <label class="col-md-3">{{__('suppliers.fields.category')}}</label>
            <div class="col-md-9">
                <input type="text" name="category" id="category" class="form-control form-control-sm" value="{{ $data->category ?? '' }}">
            </div>
        </div>
        <div class="mb-2 row">
            <label class="col-md-3">{{__('suppliers.fields.telephone')}}</label>
            <div class="col-md-3">
                <input type="text" name="telephone" id="telephone" class="form-control form-control-sm" value="{{ $data->telephone ?? '' }}">
            </div>
            <label class="col-md-3">{{__('suppliers.fields.fax')}}</label>
            <div class="col-md-3">
                <input type="text" name="fax" id="fax" class="form-control form-control-sm" value="{{ $data->fax ?? '' }}">
            </div>
        </div>
        <div class="mb-2 row">
            <label class="col-md-3">{{__('suppliers.fields.credit_limit')}}</label>
            <div class="col-md-3">
                <input type="text" name="credit_limit" id="credit_limit" class="form-control form-control-sm" value="{{ $data->credit_limit ?? '' }}">
            </div>
            <label class="col-md-3">{{__('suppliers.fields.current_balance')}}</label>
            <div class="col-md-3">
                <input type="text" name="current_balance" id="current_balance" class="form-control form-control-sm" value="{{ $data->current_balance ?? '' }}" @if(isset($data)) readonly @endif>
            </div>
        </div>
        <div class="mb-2 row">
            <label class="col-md-3">{{__('suppliers.fields.vat_reference')}}</label>
            <div class="col-md-3">
                <input type="text" name="vat_reference" id="vat_reference" class="form-control form-control-sm" value="{{ $data->vat_reference ?? '' }}">
            </div>
            <label class="col-md-3">{{__('suppliers.fields.default_tax')}}</label>
            <div class="col-md-3">
                <input type="text" name="default_tax" id="default_tax" class="form-control form-control-sm" value="{{ $data->default_tax ?? '' }}">
            </div>
        </div>

    </div> 
    <div class="col-6"> 
        <div class="mb-2 row">
            <label class="col-md-3">{{__('suppliers.fields.description')}}</label>
            <div class="col-md-9">
                <input type="text" name="description" id="description" class="form-control form-control-sm" value="{{ $data->description ?? '' }}">
            </div>
        </div>
        <div class="mb-2 row">
            <label class="col-md-3">{{__('suppliers.fields.business_address')}}</label>
            <div class="col-md-9">
                <textarea name="business_address" id="business_address" class="form-control form-control-sm" style="height: 100px">{!! $data->business_address ?? '' !!}</textarea>
            </div>
        </div>
        <div class="mb-2 row">
            <label class="col-md-3">{{__('suppliers.fields.contact_person')}}</label>
            <div class="col-md-9">
                <input type="text" name="contact_person" id="contact_person" class="form-control form-control-sm" value="{{ $data->contact_person ?? '' }}">
            </div>
        </div>
        <div class="mb-2 row">
            <label class="col-md-3">{{__('suppliers.fields.mobile_phone')}}</label>
            <div class="col-md-3">
                <input type="text" name="mobile_phone" id="mobile_phone" class="form-control form-control-sm" value="{{ $data->mobile_phone ?? '' }}">
            </div>
            <label class="col-md-2">{{__('suppliers.fields.email')}}</label>
            <div class="col-md-4">
                <input type="text" name="email" id="email" class="form-control form-control-sm" value="{{ $data->email ?? '' }}">
            </div>
        </div>
        <div class="mb-2 row">
            <label class="col-md-3">{{__('suppliers.fields.currency_code')}}</label>
            <div class="col-md-3">
                <input type="text" name="currency_code" id="currency_code" class="form-control form-control-sm" value="{{ $data->currency_code ?? '' }}">
            </div>
            <label class="col-md-3">{{__('suppliers.fields.payment_terms')}}</label>
            <div class="col-md-3">
                <input type="text" name="payment_terms" id="payment_terms" class="form-control form-control-sm" value="{{ $data->payment_terms ?? '' }}">
            </div>
        </div>
        <div class="mb-2 row">
            <label class="col-md-3">{{__('suppliers.fields.is_open_item')}}</label>
            <div class="col-md-3">
                <div class="form-check">
                    <input type="checkbox" name="is_open_item" id="is_open_item" class="form-check-input" @if(isset($data->is_open_item) && $data->is_open_item==1) checked @endif>
                </div>
            </div>
            <label class="col-md-3">{{__('suppliers.fields.is_active')}}</label>
            <div class="col-md-3">
                <div class="form-check">
                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input" @if(isset($data->is_active) && $data->is_active==1) checked @endif>
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="modal-footer">
    <input type="submit" class="btn btn-outline-primary btn-sm" value="{{ __('global.save') }}">
</div>
        
</form>
<script>
    $('#supplier_form').on('submit', function (event) {
    event.preventDefault();
    if($('#supplier_action').val() === 'Add')
    {
        $('#method').val('');
        $.ajax({
            url: "/suppliers/suppliers",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            success: function (response) {
                if(response.success){
                    $('#main_form')[0].reset();
                    
                    notice('success', '{{__('global.record_added')}}');
                }else{
                    let err='<ul class="text-start">';
                    for(let i=0; i<response.errors.length; i++)
                    {
                        err += "<li>"+response.errors[i]+"</li>";
                    }
                    err +="</ul>";
                    notice('error', '{{__('global.error_add')}}', err);
                }
            }
        });
    }else
    {
        let id = $('#suppliers_id').val();
        $('#method').val('PUT');
        $.ajax({
            url: "/suppliers/suppliers/"+id,
            method:'POST',
            data: new FormData(this),
            processData:false,
            contentType: false,
            cache: false,
            dataType: 'JSON',
            success: function(response)
            {
                if(response == 'success'){
                    
                    notice('success', '{{__('global.record_updated')}}');
                }else{
                    let err='<ul class="text-start">';
                    for(let i=0; i<response.errors.length; i++)
                    {
                        err += "<li>"+response.errors[i]+"</li>";
                    }
                    err +="</ul>";
                    notice('error', '{{__('global.error_update')}}', err);
                }
            }
        });
    }
});
</script>