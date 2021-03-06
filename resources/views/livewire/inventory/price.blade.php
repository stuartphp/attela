<div>
    <div class="form-heading mt-2 ms-2">Prices<span style="float: right"><a href="#" onclick="$('#form_price').toggle()"><i class="bi bi-plus" id="inv_price_add_close"></i></a></span></div>
<form method="post" id="form_price" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="price_action" value="add"/>
    <input type="hidden" name="_method" id="price_method">
    <input type="hidden" id="id" value="">
    <input type="hidden" name="inventory_item_id" id="price_item_id"/>
    <div class="card shaddow-sm d-none">
        <div class="card-header" id="inv_pri_header">Add Price</div>
        <div class="card-body">
            <div class="mb-2  row">
                <label class="col-md-2">{{__('inventory_prices.fields.store_id')}}</label>
                <div class="col-md-2">
                    <select name="store_id" id="store_id" class="form-select">
                        @foreach ($stores as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.price_list1')}}</label>
                <div class="col-md-2">
                    <input type="text" name="price_list1" id="price_list1" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.special')}}</label>
                <div class="col-md-2">
                    <input type="text" name="special" id="special" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
            </div>
            <div class="mb-2  row">
                <label class="col-md-2">{{__('inventory_prices.fields.cost_price')}}</label>
                <div class="col-md-2">
                    <input type="text" name="cost_price" id="cost_price" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.price_list2')}}</label>
                <div class="col-md-2">
                    <input type="text" name="price_list2" id="price_list2" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.special_from')}}</label>
                <div class="col-md-2">
                    <input type="text" name="special_from" id="special_from" class="form-control form-control-sm datetime">
                </div>
            </div>
            <div class="mb-2  row">
                <label class="col-md-2">{{__('inventory_prices.fields.retail')}}</label>
                <div class="col-md-2">
                    <input type="text" name="retail" id="retail" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.price_list3')}}</label>
                <div class="col-md-2">
                    <input type="text" name="price_list3" id="price_list3" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.special_to')}}</label>
                <div class="col-md-2">
                    <input type="text" name="special_to" id="special_to" class="form-control form-control-sm datetime">
                </div>
            </div>
            <div class="mb-2  row">
                <label class="col-md-2">{{__('inventory_prices.fields.dealer')}}</label>
                <div class="col-md-2">
                    <input type="text" name="dealer" id="dealer" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.price_list4')}}</label>
                <div class="col-md-2">
                    <input type="text" name="price_list4" id="price_list4" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
            </div><div class="mb-2  row">
                <label class="col-md-2">{{__('inventory_prices.fields.whole_sale')}}</label>
                <div class="col-md-2">
                    <input type="text" name="whole_sale" id="whole_sale" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.price_list5')}}</label>
                <div class="col-md-2">
                    <input type="text" name="price_list5" id="price_list5" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-outline-primary btn-sm" value="{{ __('global.save') }}">
        </div>
    </div>
</form>
<div class="row justify-content-start" id="priceTable">
    <div class="col-1 mt-1">
        <div class="list-group text-end group-title">
            <div class="list-group-item fw-bold">{{__('inventory_prices.fields.store_id')}}</div>
            <div class="list-group-item fw-bold">{{__('inventory_prices.fields.cost_price')}}</div>
            <div class="list-group-item fw-bold">{{__('inventory_prices.fields.retail')}}</div>
            <div class="list-group-item fw-bold">{{__('inventory_prices.fields.dealer')}}</div>
            <div class="list-group-item fw-bold">{{__('inventory_prices.fields.whole_sale')}}</div>
            <div class="list-group-item fw-bold">{{__('inventory_prices.fields.price_list1')}}</div>
            <div class="list-group-item fw-bold">{{__('inventory_prices.fields.price_list2')}}</div>
            <div class="list-group-item fw-bold">{{__('inventory_prices.fields.price_list3')}}</div>
            <div class="list-group-item fw-bold">{{__('inventory_prices.fields.price_list4')}}</div>
            <div class="list-group-item fw-bold">{{__('inventory_prices.fields.price_list5')}}</div>
            <div class="list-group-item fw-bold">{{__('inventory_prices.fields.special')}}</div>
            <div class="list-group-item fw-bold">{{__('inventory_prices.fields.special_from')}}</div>
            <div class="list-group-item fw-bold">{{__('inventory_prices.fields.special_to')}}</div>
            <div class="list-group-item fw-bold pt-3 pb-2">{{ __('global.action') }}</div>
        </div>
    </div>
    <div class="col-11">
        <div class="flow-container flex">
            @foreach ($prices as $item)
            <div class="item flex-item">
                <div class="list-group">
                    <div class="list-group-item text-center"><b>{{($item->store->name)??'-'}}</b></div>
                    <div class="list-group-item text-end">{{(number_format($item->cost_price,2))??'-'}}</div>
                    <div class="list-group-item text-end">{{(number_format($item->retail,2))??'-'}}</div>
                    <div class="list-group-item text-end">{{(number_format($item->dealer,2))??'-'}}</div>
                    <div class="list-group-item text-end">{{(number_format($item->whole_sale,2))??'-'}}</div>
                    <div class="list-group-item text-end">{{(number_format($item->price_list1,2))??'-'}}</div>
                    <div class="list-group-item text-end">{{(number_format($item->price_list2,2))??'-'}}</div>
                    <div class="list-group-item text-end">{{(number_format($item->price_list3,2))??'-'}}</div>
                    <div class="list-group-item text-end">{{(number_format($item->price_list4,2))??'-'}}</div>
                    <div class="list-group-item text-end">{{(number_format($item->price_list5,2))??'-'}}</div>
                    <div class="list-group-item text-end">{{(number_format($item->special,2))??'-'}}</div>
                    <div class="list-group-item text-center">{{($item->special_from)??'-'}}</div>
                    <div class="list-group-item text-center">{{($item->special_to)??'-'}}</div>
                    <div class="list-group-item"><select class="inv_price_action form-select" id="pri_{{ $item->inventory_item_id }}_{{ $item->id }}">
                        <option value="">{{ __('global.select') }}</option>
                        <option value="Copy">{{ __('global.copy') }}</option>
                        <option value="Edit">{{ __('global.edit') }}</option>
                        <option value="Delete">{{ __('global.delete') }}</option>
                        </select></div>
                </div>
            </div>
            @endforeach
  </div>
    </div>
</div>
</div>
