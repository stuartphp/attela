<div>
    <div class="card mt-1">
        <div class="card-header">
            <div class="row">
                <div class="col-9"><div ms-2">Prices</div></div>
                <div class="col-3 text-end">
                    <div class="row">
                        <div class="col-1">
                            <a href="#" wire:click.prevent='priceAction("Add", 0)' ><i class="bi bi-plus fa-1x" id="inv_price_add_close"></i></a>
                        </div>
                        <div class="col-3"><input type="text" wire:model.debounce.300ms="size" placeholder="{{ __('global.size') }}" class="form-control form-control-sm"/></div>
                        <div class="col-8"><input type="text" wire:model.debounce.300ms="search" name="search" class="form-control form-control-sm"/></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="priceTable">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Store</th>
                            <th class="text-center">cost_price</th>
                            <th class="text-center">retail</th>
                            <th class="text-center">dealer</th>
                            <th class="text-center">whole_sale</th>
                            <th class="text-center">price_list1</th>
                            <th class="text-center">price_list2</th>
                            <th class="text-center">price_list3</th>
                            <th class="text-center">price_list4</th>
                            <th class="text-center">price_list5</th>
                            <th class="text-center">special</th>
                            <th class="text-center">special_from</th>
                            <th class="text-center">special_to</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($prices as $index =>$price)
                        <tr>
                            <td>{{ $price->store }}</td>
                            <td class="text-end">{{ number_format($price->cost_price,2) }}</td>
                            <td class="text-end">{{ number_format($price->retail,2) }}</td>
                            <td class="text-end">{{ number_format($price->dealer,2) }}</td>
                            <td class="text-end">{{ number_format($price->whole_sale,2) }}</td>
                            <td class="text-end">{{ number_format($price->price_list1,2) }}</td>
                            <td class="text-end">{{ number_format($price->price_list2,2) }}</td>
                            <td class="text-end">{{ number_format($price->price_list3,2) }}</td>
                            <td class="text-end">{{ number_format($price->price_list4,2) }}</td>
                            <td class="text-end">{{ number_format($price->price_list5,2) }}</td>
                            <td class="text-end">{{ number_format($price->special,2) }}</td>
                            <td class="text-center">{{ $price->special_from }}</td>
                            <td class="text-center">{{ $price->special_to }}</td>
                            <td class="col-1"><select class="form-select" wire:change='priceAction($event.target.value, {{ $price->id }})' id="price_{{ $price->id }}" onclick="$('#price_{{ $price->id }}').val('')">
                                <option value="" selected>{{ __('global.select') }}</option>
                                <option value="Copy">{{ __('global.copy') }}</option>
                                <option value="Edit">{{ __('global.edit') }}</option>
                                <option value="Delete">{{ __('global.delete') }}</option>
                                </select></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="14">{{ $prices->links() }}</td>
                    </tr>
                </tfoot>
                </table>
            </div>
        </div>
    </div>

<div class="modal" tabindex="-1" id="priceModal" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $formTitle }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" wire:mode="formAction"/>
            <div class="mb-2  row">
                <label class="col-md-2">{{__('inventory_prices.fields.store_id')}}</label>
                <div class="col-md-2">
                    <select name="store_id" id="store_id" wire:model="store_id" class="form-select">
                        @foreach ($stores as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.price_list1')}}</label>
                <div class="col-md-2">
                    <input type="text" wire:model="price_list1" name="price_list1" id="price_list1" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.special')}}</label>
                <div class="col-md-2">
                    <input type="text" wire:model="special" name="special" id="special" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
            </div>
            <div class="mb-2  row">
                <label class="col-md-2">{{__('inventory_prices.fields.cost_price')}}</label>
                <div class="col-md-2">
                    <input type="text" wire:model="cost_price" name="cost_price" id="cost_price" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.price_list2')}}</label>
                <div class="col-md-2">
                    <input type="text" wire:model="price_list2" name="price_list2" id="price_list2" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.special_from')}}</label>
                <div class="col-md-2">
                    <input type="text" name="special_from" id="special_from" class="form-control form-control-sm datetime">
                </div>
            </div>
            <div class="mb-2  row">
                <label class="col-md-2">{{__('inventory_prices.fields.retail')}}</label>
                <div class="col-md-2">
                    <input type="text" wire:model="retail" name="retail" id="retail" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.price_list3')}}</label>
                <div class="col-md-2">
                    <input type="text" wire:model="price_list3" name="price_list3" id="price_list3" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.special_to')}}</label>
                <div class="col-md-2">
                    <input type="text" wire:model="special_to" name="special_to" id="special_to" class="form-control form-control-sm datetime">
                </div>
            </div>
            <div class="mb-2  row">
                <label class="col-md-2">{{__('inventory_prices.fields.dealer')}}</label>
                <div class="col-md-2">
                    <input type="text" wire:model="dealer" name="dealer" id="dealer" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.price_list4')}}</label>
                <div class="col-md-2">
                    <input type="text" wire:model="price_list4" name="price_list4" id="price_list4" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
            </div><div class="mb-2  row">
                <label class="col-md-2">{{__('inventory_prices.fields.whole_sale')}}</label>
                <div class="col-md-2">
                    <input type="text" wire:model='whole_sale' name="whole_sale" id="whole_sale" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.price_list5')}}</label>
                <div class="col-md-2">
                    <input type="text" wire:model="price_list5" name="price_list5" id="price_list5" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" wire:click="priceCrud" class="btn btn-outline-primary btn-sm" value="{{ $formButton }}">
        </div>
        </div>
    </div>
</div>

</div>

