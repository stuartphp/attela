<div>
    

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
        @foreach ($prices as $price)
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
                <td class="col-1"><select class="inv_price_action form-select" id="pri_{{ $price->inventory_item_id }}_{{ $price->id }}">
                    <option value="">{{ __('global.select') }}</option>
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
