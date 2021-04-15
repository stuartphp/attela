<div>
    <form action="/documents/documents/{{ $doc_id }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT"/>
        @csrf
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
                    <input type="hidden" name="physical_address" value="{{ $physical_address }}"/>
                    @if ($editAddressField === 'physical_address')
                        <div class="row">
                            <div class="col-10"><textarea class="form-control form-control-sm"
                            wire:model.lazy="physical_address" >{{ $physical_address }}</textarea></div>
                            <div class="col-2"><button class="btn btn-outline-primary btn-xs" wire:click='saveAddress()'>{{ __('global.update') }}</button></div>
                        </div>
                    @else
                        <div style="cursor: pointer" wire:click.prevent="editAddress('physical_address')">{!! nl2br($physical_address) !!}</div>
                    @endif
                </div>
                <div class="col-4">
                    <b>Deliver To:</b>
                    <input type="hidden" name="delivery_address" value="{{ $delivery_address }}"/>
                    @if ($editAddressField === 'delivery_address')
                        <div class="row">
                            <div class="col-10"><textarea class="form-control form-control-sm"
                                name="delivery_address"
                            wire:model.lazy="delivery_address" >{{ $delivery_address }}</textarea></div>
                            <div class="col-2"><button class="btn btn-outline-primary btn-xs" wire:click.prevent='saveAddress()'>{{ __('global.update') }}</button></div>
                        </div>
                    @else
                    <div style="cursor: pointer" wire:click="editAddress('delivery_address')">{!! nl2br($delivery_address) !!}</div>
                    @endif
                </div>
                <div class="col-2">
                    <div class="fx-1"><strong>Detail:</strong></div>
                    <div class="row">
                        <div class="col-6">Date</div>
                        <div class="col-6 mt-1"><strong>{{ $document['action_date'] }}</strong></div>
                        <div class="col-6 mt-1">Delivery Date</div>
                        <div class="col-6 mt-1"><input type="text" name="expire_delivery" class="form-control form-control-sm date" value="{{ $document['expire_delivery'] }}"/></div>
                        <div class="col-6 mt-1">Reference</div>
                        <div class="col-6 mt-1"><strong>{{ $document['reference_number'] }}</strong></div>
                        <div class="col-6 mt-1">Sales Code</div>
                        <div class="col-6 mt-1"><strong>{{ $document['sales_code'] }}</strong></div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="fx-1"><strong>Account:</strong></div>
                    <div class="row">
                        <div class="col-6 mt-1">Terms</div>
                        <div class="col-6 mt-1"><strong>{{ __('accounting_lookup.payment_terms.'.$document['terms']) }}</strong></div>
                        <div class="col-6 mt-1">Credit Limit</div>
                        <div class="col-6 mt-1"><strong>{{ $credit_limit }}</strong></div>
                        <div class="col-6 mt-1">Balance</div>
                        <div class="col-6 mt-1"><strong>{{ $balance }}</strong></div>
                        <div class="col-6 mt-1">Available</div>
                        <div class="col-6 mt-1"><strong>{{ $available }}</strong></div>
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
                            <input type="hidden" name="items[{{ $index }}][item_id]" wire:model="items.{{ $index }}.item_id" value="{{ $item['item_id'] }}"/>
                            <input type="hidden" name="items[{{ $index }}][store_id]" wire:model="items.{{ $index }}.store_id" value="{{ $item['store_id'] }}"/>
                            <input type="hidden" name="items[{{ $index }}][unit_price]" wire:model="items.{{ $index }}.unit_price" value="{{ $item['unit_price'] }}"/>
                            <input type="hidden" name="items[{{ $index }}][is_service]" wire:model="items.{{ $index }}.is_service" value="{{ $item['is_service'] }}"/>
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
                            <td><input type="text" class="form-control form-control-sm text-end"
                                name="items[{{ $index }}][price_excl]"
                                wire:model="items.{{ $index }}.price_excl"
                                value="{{ number_format($item['price_excl'],2) }}"
                                wire:change="updateItem()"
                                onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')"
                                /></td>
                            <td><select class="form-select"
                                wire:model="items.{{ $index }}.tax_type"
                                wire:change="updateItem()"
                                name="items[{{ $index }}][tax_type]">
                            @foreach ($listVat as $i=>$o)
                                <option value="{{ $i }}">{{ $o }}</option>
                            @endforeach
                            </select></td>
                            <td><input type="text" class="form-control form-control-sm text-end"
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
                                    @foreach ($searchItemResult as $k=>$v)
                                    <button type="button" @click="open=false" wire:click="addItem({{ $k }})" class="list-group-item list-group-item-action list-group-item-info">{{ $v }}</button>
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


