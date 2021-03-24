<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
    public function index($id)
    {
        $item = DB::table('inventory_items')->where('inventory_items.id', $id)
        ->join('inventory_categories', 'inventory_categories.id', '=', 'inventory_items.category_id')
        ->leftJoin('inventory_levels', 'inventory_levels.inventory_item_id', '=', 'inventory_items.id')
        ->select('inventory_items.*', 'inventory_categories.main_category', 'inventory_categories.sub_category', 'inventory_levels.on_hand','inventory_levels.min_order_level', 'inventory_levels.min_order_quantity')
        ->first();

        return view('inventory.detail', compact('item'));
    }
}
