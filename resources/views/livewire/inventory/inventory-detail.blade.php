<div>
    @livewire('inventory.inventory-list')
    @if (!$item_id)
        <span style="font-size:1.25rem; cursor:pointer" onclick="openNav()">&#9776;</span>
    @endif
    @if ($item_id)
        <nav class="navbar navbar-expand-lg navbar-light" id="items_nav" style="background-color: #EDF1ED">
            <div class="container-fluid">
                <div class="navbar-brand"><a href="#" style="font-size:1.25rem; cursor:pointer"
                        onclick="openNav()">&#9776;</a> ({{ $item_code }}) {{ $description }}</div>
                <ul class="nav nav-pills" id="detailTab">
                    <li class="nav-item">
                        <a class="nav-link active" id="detail-tab" data-bs-toggle="tab" href="#detail" role="tab"
                            aria-controls="detail" aria-selected="true">Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="prices-tab" data-bs-toggle="tab" href="#prices" role="tab"
                            aria-controls="prices" aria-selected="false">Prices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="options-tab" data-bs-toggle="tab" href="#options" role="tab"
                            aria-controls="options" aria-selected="false">Options</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="levels-tab" data-bs-toggle="tab" href="#levels" role="tab"
                            aria-controls="levels" aria-selected="false">Levels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="images-tab" data-bs-toggle="tab" href="#images" role="tab"
                            aria-controls="images" aria-selected="false">Images</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="activities-tab" data-bs-toggle="tab" href="#activities" role="tab"
                            aria-controls="activities" aria-selected="false">Activities</a>
                    </li>
                </ul>
        </nav>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                <div class="card mt-1">
                    <div class="card-header">Details</div>
                    <div class="card-body">
                        <div class="row ms-2 me-2">
                            <div class="col-6">
                                <div class="row mb-2">
                                    <label class="col-3">{{ __('inventory_items.fields.item_code') }}</label>
                                    <div class="col-9"><input type="text" wire:model="item_code"
                                            class="form-control form-control-sm"></div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-3">{{ __('inventory_items.fields.description') }}</label>
                                    <div class="col-9">
                                        <input type="text" wire:model="description"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-3">{{ __('inventory_items.fields.dictation') }}</label>
                                    <div class="col-9">
                                        <textarea wire:model="dictation"
                                            class="form-control form-control-sm"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-3">{{ __('inventory_items.fields.keywords') }}</label>
                                    <div class="col-9">
                                        <input type="text" wire:model="keywords" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-3">{{ __('inventory_items.fields.tags') }}</label>
                                    <div class="col-9">
                                        <input type="text" wire:model="tags" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-3">{{ __('inventory_items.fields.barcode') }}</label>
                                    <div class="col-9">
                                        <input type="text" wire:model="barcode" id="barcode"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-3">{{ __('inventory_items.fields.isbn_number') }}</label>
                                    <div class="col-9">
                                        <input type="text" wire:model="isbn_number" id="isbn_number"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-3">{{ __('inventory_items.fields.category_id') }} <a href="#"
                                            data-bs-toggle="modal" data-bs-target="#modalCategory"><i
                                                class="bi bi-plus fa-1x" id="inv_img_add_category"></i></a></label>
                                    <div class="col-9">
                                        <select wire:model="category_id" id="category_id"
                                            class="form-select">{!! $categories !!}</select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row mb-2">
                                    <label class="col-3">{{ __('inventory_items.fields.unit') }} <a href="#"
                                            data-bs-toggle="modal" data-bs-target="#modalUnit"><i
                                                class="bi bi-plus fa-1x" id="inv_img_add_unit"></i></a></label>
                                    <div class="col-9">
                                        <select wire:model="unit" id="unit" class="form-select">
                                            @foreach ($units as $k => $v)
                                                <option value="{{ $k }}">{{ $v }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-3">{{ __('inventory_items.fields.commodity_code') }}</label>
                                    <div class="col-9">
                                        <input type="text" wire:model="commodity_code" id="commodity_code"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-3">{{ __('inventory_items.fields.nett_mass_gram') }}</label>
                                    <div class="col-9">
                                        <input type="number" wire:model="nett_mass_gram" id="nett_mass_gram"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-3">{{ __('inventory_items.fields.is_service') }}</label>
                                    <div class="col-9">
                                        <div class="form-check">
                                            <input type="checkbox" wire:model="is_service" id="is_service"
                                                class="form-check-input" @if (isset($data->is_service) && $data->is_service == 1) checked @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-3">{{ __('inventory_items.fields.allow_tax') }}</label>
                                    <div class="col-9">
                                        <div class="form-check">
                                            <input type="checkbox" wire:model="allow_tax" id="allow_tax"
                                                class="form-check-input" @if (isset($data->allow_tax) && $data->allow_tax == 1) checked @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-3">{{ __('inventory_items.fields.purchase_tax_type') }}</label>
                                    <div class="col-9">
                                        <select wire:model="purchase_tax_type" id="purchase_tax_type"
                                            class="form-select">
                                            @foreach (__('accounting_lookup.tax_types') as $k => $v)
                                                <option value="{{ $k }}">{{ $v['trans'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-3">{{ __('inventory_items.fields.sales_tax_type') }}</label>
                                    <div class="col-9">
                                        <select wire:model="sales_tax_type" id="sales_tax_type" class="form-select">
                                            @foreach (__('accounting_lookup.tax_types') as $k => $v)
                                                <option value="{{ $k }}">{{ $v['trans'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label
                                        class="col-3">{{ __('inventory_items.fields.is_fixed_description') }}</label>
                                    <div class="col-9">
                                        <div class="form-check">
                                            <input type="checkbox" wire:model="is_fixed_description"
                                                id="is_fixed_description" class="form-check-input" @if (isset($data->is_fixed_description) && $data->is_fixed_description == 1) checked @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label
                                        class="col-3">{{ __('inventory_items.fields.sales_commission_item') }}</label>
                                    <div class="col-9">
                                        <div class="form-check">
                                            <input type="checkbox" wire:model="sales_commission_item"
                                                id="sales_commission_item" class="form-check-input" @if (isset($data->sales_commission_item) && $data->sales_commission_item == 1) checked @endif>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label class="col-3">{{ __('inventory_items.fields.is_active') }}</label>
                                    <div class="col-9">
                                        <div class="form-check">
                                            <input type="checkbox" wire:model="is_active" id="is_active"
                                                class="form-check-input" @if (isset($data->is_active) && $data->is_active == 1) checked @endif>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-outline-warning btn-sm" id="copyBtn" onclick="copyItem()"
                            value="{{ __('global.copy') }}">
                        <input type="submit" class="btn btn-outline-primary btn-sm" value="{{ __('global.save') }}">
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="prices" role="tabpanel" aria-labelledby="prices-tab">
                @livewire('inventory.inventory-price', ['item_id'=>$item_id])
            </div>
            <div class="tab-pane fade" id="options" role="tabpanel" aria-labelledby="options-tab">
            </div>
            <div class="tab-pane fade" id="levels" role="tabpanel" aria-labelledby="levels-tab">
            </div>
            <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
            </div>
            <div class="tab-pane fade" id="activities" role="tabpanel" aria-labelledby="activities-tab">
            </div>
        </div>
    @endif
</div>
