<div class="form-heading mt-2 ms-2 me-2">
    <span style="cursor:pointer" onclick="openNav()">{!! isset($data->id) ? '': '&#9776;' !!}</span>
    {{ __('inventory_items.title_singular') }}</div>
<form method="post" id="form_item" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="inv_item_action" value="{{ isset($data->id) ? 'Update':'Add' }}" />
    <input type="hidden" name="_method" id="method">
    <input type="hidden" id="id" value="">
<div class="row ms-2 me-2">
    <div class="col-6">
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.item_code') }}</label>
            <div class="col-9"><input type="text" name="item_code" id="item_code" class="form-control form-control-sm" value="{{ $data->item_code ?? ''}}"></div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.description') }}</label>
            <div class="col-9">
                <input type="text" name="description" id="description" class="form-control form-control-sm" value="{{ $data->description ?? '' }}">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.dictation') }}</label>
            <div class="col-9">
                <textarea name="dictation" id="dictation" class="form-control">{!! $data->dictation ?? '' !!}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.keywords') }}</label>
            <div class="col-9">
                <input type="text" name="keywords" id="keywords" class="form-control form-control-sm" value="{{ $data->keywords ?? '' }}">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.tags') }}</label>
            <div class="col-9">
                <input type="text" name="tags" id="tags" class="form-control form-control-sm" value="{{ $data->tags ?? '' }}">
            </div>
        </div>
        

    </div>
    <div class="col-6">
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.barcode') }}</label>
            <div class="col-9">
                <input type="text" name="barcode" id="barcode" class="form-control form-control-sm" value="{{ $data->barcode ?? '' }}">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.isbn_number') }}</label>
            <div class="col-9">
                <input type="text" name="isbn_number" id="isbn_number" class="form-control form-control-sm" value="{{ $data->isbn_number ?? '' }}">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.category_id') }} <a href="#" data-bs-toggle="modal" data-bs-target="#modalCategory"><i class="bi bi-plus fa-1x" id="inv_img_add_category"></i></a></label>
            <div class="col-9">
                <select name="category_id" id="category_id" class="form-select">{!! $cats !!}</select>
            </div>
        </div>        
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.unit') }}  <a href="#"  data-bs-toggle="modal" data-bs-target="#modalUnit"><i class="bi bi-plus fa-1x" id="inv_img_add_unit"></i></a></label>
            <div class="col-9">
                <select name="unit" id="unit" class="form-select">
                    @foreach($units as $k=>$v)
                    <option value="{{ $k }}" @if(isset($data->unit) && $k==$data->unit) selected @endif>{{ $v }}   </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.commodity_code') }}</label>
            <div class="col-9">
                <input type="text" name="commodity_code" id="commodity_code" class="form-control form-control-sm" value="{{ $data->commodity_code ?? '' }}">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.nett_mass_gram') }}</label>
            <div class="col-9">
                <input type="number" name="nett_mass_gram" id="nett_mass_gram" class="form-control form-control-sm" value="{{ $data->nett_mass_gram ?? '' }}">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.is_service') }}</label>
            <div class="col-9">
                <div class="form-check">
                    <input type="checkbox" name="is_service" id="is_service" class="form-check-input" @if(isset($data->is_service) && $data->is_service==1) checked @endif>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.allow_tax') }}</label>
            <div class="col-9">
                <div class="form-check">
                    <input type="checkbox" name="allow_tax" id="allow_tax" class="form-check-input" @if(isset($data->allow_tax) && $data->allow_tax==1) checked @endif>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.purchase_tax_type') }}</label>
            <div class="col-9">
                <select name="purchase_tax_type" id="purchase_tax_type" class="form-select">
                @foreach (__('accounting_lookup.tax_types') as $k=>$v)
                <option value="{{ $k }}" @if(isset($data->purchase_tax_type) && $k==$data->purchase_tax_type) selected @endif>{{ $v['trans'] }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.sales_tax_type') }}</label>
            <div class="col-9">
                <select name="sales_tax_type" id="sales_tax_type" class="form-select">
                    @foreach (__('accounting_lookup.tax_types') as $k=>$v)
                    <option value="{{ $k }}" @if(isset($data->sales_tax_type) && $k==$data->sales_tax_type) selected @endif>{{ $v['trans'] }}</option>
                    @endforeach
                    </select>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.is_fixed_description') }}</label>
            <div class="col-9">
                <div class="form-check">
                    <input type="checkbox" name="is_fixed_description" id="is_fixed_description" class="form-check-input" @if(isset($data->is_fixed_description) && $data->is_fixed_description==1) checked @endif>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.sales_commission_item') }}</label>
            <div class="col-9">
                <div class="form-check">
                    <input type="checkbox" name="sales_commission_item" id="sales_commission_item" class="form-check-input" @if(isset($data->sales_commission_item) && $data->sales_commission_item==1) checked @endif>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-3">{{ __('inventory_items.fields.is_active') }}</label>
            <div class="col-9">
                <div class="form-check">
                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input" @if(isset($data->is_active) && $data->is_active==1) checked @endif>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" class="btn btn-outline-warning btn-sm" id="copyBtn" onclick="copyItem()" value="{{ __('global.copy') }}">
    <input type="submit" class="btn btn-outline-primary btn-sm" value="{{ __('global.save') }}">
</div>

</form>

<div class="modal fade" tabindex="-1" id="modalCategory">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <label>Main Category</label>
            <input type="text" name="name" id="unit_name" class="form-control form-control-sm"/>
            <label>Sub Category</label>
            <input type="text" name="name" id="unit_name" class="form-control form-control-sm"/>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary btn-sm">Save changes</button>
        </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="modalUnit">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Unit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <label>Unit</label>
            <input type="text" name="name" id="unit_name" class="form-control form-control-sm"/>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary btn-sm" onclick="saveUnit()">Save</button>
        </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#dictation').summernote({
        placeholder: '',
        tabsize: 2,
        height: 260,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link']],
          ['view', ['help']]
        ]
      });
    });
    $('#unit').select2({
        tags:true
    });
    
    function copyItem()
    {
        $('#inv_item_action').val('Add');
        $('#method').val('');
        $('#inventory_item_id').val('');
        $('#items_nav').toggle();
        $('#copyBtn').toggle();
    }
    $('#form_item').on('submit', function (event) {
        event.preventDefault();
        if($('#inv_item_action').val() === 'Update')
        {
            let id = $('#inventory_item_id').val();
            $('#method').val('PUT');
            $.ajax({
                url: "/inventory/items/"+id,
                method:'POST',
                data: new FormData(this),
                processData:false,
                contentType: false,
                cache: false,
                dataType: 'JSON',
                success: function(response)
                {
                    if(response.success){ 
                        
                        $('#I'+id).removeClass('list-group-item-danger');
                        $('#I'+id).removeClass('list-group-item-success');
                        $('#I'+id).html($('#item_code').val()+': '+$('#description').val());                     
                        if(parseFloat(response.success.is_active)===1){                            
                            $('#I'+id).addClass('list-group-item-success');
                        }else{
                            $('#I'+id).addClass('list-group-item-danger');
                        }        
                        notice('success', '{{trans('global.record_updated')}}');
                    }else{
                        let err='<ul class="text-left">';
                        for(let i=0; i<response.length; i++)
                        {
                            err += "<li>"+response[i]+"</li>";
                        }
                        err +="</ul>";
                        notice('error', '{{trans('global.error_update')}}', err);
                    }
                }
            });
        }else{
            
            $.ajax({
                url: "/inventory/items",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'JSON',
                success: function (response) {
                    if(response.success){
                        notice('success', '{{trans('global.record_added')}}');
                    }else{
                        let err='<ul class="text-left">';
                        for(let i=0; i<response.length; i++)
                        {
                            err += "<li>"+response[i]+"</li>";
                        }
                        err +="</ul>";
                        notice('error', '{{trans('global.error_add')}}', err);
                    }
                }
            });
        }
    });

    function saveUnit()
    {
        alert('unit');
    }
</script>

