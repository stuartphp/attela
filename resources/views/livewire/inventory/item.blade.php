<div>
    <div class="card mt-1">
        <div class="card-header">Details</div>
        <div class="card-body">
            <div class="row ms-2 me-2">
        <div class="col-6">
            <div class="row mb-2">
                <label class="col-3">{{ __('inventory_items.fields.item_code') }}</label>
                <div class="col-9"><input type="text" wire:model="item_code" class="form-control form-control-sm"></div>
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
                    <select name="category_id" id="category_id" class="form-select">{!! $categories !!}</select>
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

        </div>
        <div class="col-6">

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
        </div><div class="modal-footer">
        <input type="button" class="btn btn-outline-warning btn-sm" id="copyBtn" onclick="copyItem()" value="{{ __('global.copy') }}">
        <input type="submit" class="btn btn-outline-primary btn-sm" value="{{ __('global.save') }}">
    </div>
    </div>


</div>
