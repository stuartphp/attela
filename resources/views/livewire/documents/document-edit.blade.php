<div>
    <div class="card mt-2" style="background-color: {{ $color }}">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    {{ $entity_name }} : {{ $type }} : {{ $doc_number }}
                </div>
            </div>
        </div>
        <div class="card-body" style="background-color:white;">
            <div class="row">
                <div class="col-4">
                    <b>Billed To:</b>
                    @if ($editAddressField === 'physical_address')
                        <textarea class="form-control" x-on:click.away=="editAddressField=''" >{{ ($document['physical_address']) }}</textarea>
                    @else
                    <div style="cursor: pointer" wire:click="editAddress('physical_address')">{!! nl2br($document['physical_address']) !!}</div>
                    @endif
                </div>
                <div class="col-4">
                    <b>Deliver To:</b>
                    @if ($editAddressField === 'delivery_address')
                        <textarea class="form-control" x-on:click.away=="editAddressField=''" >{{ ($document['delivery_address']) }}</textarea>
                    @else
                    <div style="cursor: pointer" wire:click="editAddress('delivery_address')">{!! nl2br($document['delivery_address']) !!}</div>
                    @endif
                </div>
                <div class="col-2">
                    <div class="fx-1"><strong>Detail:</strong></div>
                    <div class="row">
                        <div class="col-7">Date</div>
                        <div class="col-5 mt-1"><strong>{{ $document['action_date'] }}</strong></div>
                        <div class="col-7 mt-1">Delivery Date</div>
                        <div class="col-5 mt-1"><strong>{{ $document['expire_delivery'] }}</strong></div>
                        <div class="col-7 mt-1">Reference</div>
                        <div class="col-5 mt-1"><strong>{{ $document['reference_number'] }}</strong></div>
                        <div class="col-7 mt-1">Sales Code</div>
                        <div class="col-5 mt-1"><strong>{{ $document['sales_code'] }}</strong></div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="fx-1"><strong>Account:</strong></div>
                    <div class="row">
                        <div class="col-7 mt-1">Terms</div>
                        <div class="col-5 mt-1"><strong>{{ __('accounting_lookup.payment_terms.'.$document['terms']) }}</strong></div>
                        <div class="col-7 mt-1">Credit Limit</div>
                        <div class="col-5 mt-1"><strong>{{ $credit_limit }}</strong></div>
                        <div class="col-7 mt-1">Balance</div>
                        <div class="col-5 mt-1"><strong>{{ $balance }}</strong></div>
                        <div class="col-7 mt-1">Available</div>
                        <div class="col-5 mt-1"><strong>{{ $available }}</strong></div>
                    </div>
                </div>
            </div>
            <div class="row mt-2 table-resonsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="col-1">{{ __('documents.doc.code') }}</th>
                            <th class="">{{ __('documents.doc.description') }}</th>
                            <th class="">{{ __('documents.doc.options') }}</th>
                            <th class="">{{ __('documents.doc.unit') }}</th>
                            <th class="col-1 text-center">{{ __('documents.doc.quantity') }}</th>
                            <th class="col-1 text-center">{{ __('documents.doc.price_excl') }}</th>
                            <th class="col-1 text-center">{{ __('documents.doc.vat') }}</th>
                            <th class="col-1 text-center">{{ __('documents.doc.discount') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $index => $item )
                        <tr id="row_{{ $index }}">
                            <td><input type="text" class="form-control form-control-sm"
                                name="items[{{ $index }}][item_code]"
                                wire:model="items.{{ $index }}.item_code"
                                value="{{$item['item_code']}}"/></td>
                            <td><input type="text" class="form-control form-control-sm"
                                name="items[{{ $index }}][item_description]"
                                wire:model="items.{{ $index }}.item_description"
                                value="{{$item['item_description']}}"/></td>
                            <td><input type="text" class="form-control form-control-sm"
                                name="items[{{ $index }}][option]"
                                wire:model="items.{{ $index }}.options"
                                value="{{$item['options']}}"/></td>
                            <td><select class="form-select" name="items[{{ $index }}][unit]"
                                wire:model="items.{{ $index }}.unit">
                                @foreach ($listUnits as $k=>$v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                                </select></td>
                            <td class="text-center">
                                <input type="text" class="form-control form-control-sm"
                                name="items[{{ $index }}][quantity]"
                                wire:model="items.{{ $index }}.quantity"
                                wire:change="updateItem()"
                                value="{{ number_format($item['quantity'],2) }}"
                                onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')"/>
                            </td>
                            <td class="text-end"><input type="text" class="form-control form-control-sm"
                                name="items[{{ $index }}][price_excl]"
                                wire:model="items.{{ $index }}.price_excl"
                                value="{{ number_format($item['price_excl'],2) }}"
                                wire:change="updateItem()"
                                onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')"
                                /></td>
                            <td class="text-end"><select class="form-select"
                                wire:model="items.{{ $index }}.tax_type"
                                wire:change="updateItem()"
                                name="items[{{ $index }}][tax_type]">
                            @foreach ($listVat as $i=>$o)
                                <option value="{{ $i }}">{{ $o }}</option>
                            @endforeach
                            </select></td>
                            <td class="text-end"><input type="text" class="form-control form-control-sm"
                                name="items[{{ $index }}][discount_perc]"
                                wire:model="items.{{ $index }}.discount_perc"
                                wire:change="updateItem()"
                                value="{{ number_format($item['discount_perc'],2) }}"
                                onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')"/></td>
                            <td class="text-end">
                                <i class="bi bi-trash text-danger form-control-color" wire:click="deleteItem({{ $index }})"></i></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-1">
                        <select class="form-select" wire:model="store">
                            @foreach ($stores as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <div style="position: relative" x-data="{ open: false }" @click.away="open = false">
                            <input class="form-control form-control-sm dropdown-toggle"
                                wire:model.debounce.100ms="searchItem"
                                placeholder="{{ __('global.add_item') }}"
                                @click="open = true"
                            />
                            <div x-show="open" style="position: absolute; z-index:1000; width:100%" @away class="list-group">
                                    @foreach ($searchItemResult as $result)
                                    <button type="button" @click="open=false" wire:click="addItem({{ $result['id'] }})" class="list-group-item list-group-item-action list-group-item-info">{{ $result['description'] }}</button>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row h6">
                <div class="col-sm-2">Nett Price : <strong>{{ number_format($nett, 2) }}</strong></div>
                <div class="col-sm-2">Discount : <strong>{{ number_format($discount, 2) }}</strong></div>
                <div class="col-sm-2">Exclusive : <strong>{{ number_format($sub_total, 2) }}</strong></div>
                <div class="col-sm-2">Tax : <strong>{{ number_format($vat, 2) }}</strong></div>
                <div class="col-sm-2">Items : <strong>{{ number_format($qty, 2) }}</strong></div>
                <div class="col-sm-2">Total Due : <strong>{{ number_format($total, 2) }}</strong></div>
            </div>

        </div>
    </div>
    <div class="text-end mt-2 me-2"><input type="submit" class="btn btn-outline-primary btn-sm" id="saveBtn" value="Save"></div>
</div>


