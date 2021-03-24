<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryItem;

class InventoryController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $search = request()->get('search');
            $res = InventoryItem::where('company_id', session()->get('company_id'))
            ->where('description', 'like', "%$search%")
            ->orderBy('description', 'asc')
            ->pluck('description', 'id');
            foreach ($res as $key=>$val)
            {
                $z[]=['id'=>$key, 'text'=>$val];
            }
            return $z;
        }
    }
    public function document()
    {
        $z=[];
        $price_list = request('price_list');
        $val = request('search');
        $store = request('store');
        if($price_list != 'supplier') {
            $field = 'inventory_prices.' . $price_list . ' as price';
            $data = InventoryItem::join('inventory_prices', 'inventory_prices.inventory_item_id', '=', 'inventory_items.id')
                ->where('company_id', session()->get('company_id'))
                ->select("inventory_items.*", $field, 'inventory_prices.cost_price')
                ->where('inventory_prices.store_id', $store)
                ->where('description', 'LIKE', "%$val%")
                ->orderBy('description')
                ->limit(15)
                ->get();
            foreach ($data as $d)
            {
                $z[]=['id'=>$d->id.'~'.$d->item_code.'~'.$d->description.'~'.$d->unit.'~'.$d->price.'~'.$d->cost_price.'~'.$d->sales_tax_type.'~'.$d->is_service, 'text'=>$d->description];
            }
        }else{
            $data = DB::table('supplier_items')->where('supplier_id', $store)
                ->where('description', 'like', "%$val%")
                ->get();
                foreach ($data as $d)
                {
                    $z[]=['id'=>$d->id.'~'.$d->item_code.'~'.$d->description.'~'.$d->unit.'~'.$d->price_excl.'~'.$d->price_excl.'~'.$d->tax_code.'~0', 'text'=>$d->description];
                }
        }

        return response()->json($z);
    }

}
