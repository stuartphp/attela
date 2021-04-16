<?php

namespace App\Http\Livewire\Inventory;

use App\Models\InventoryPrice;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Price extends Component
{
    public $prices;
    public $stores;

    public function mount($id)
    {
        $this->stores = DB::table('stores')->where('company_id', session()->get('company_id'))->pluck('name', 'id')->toArray();
        $this->prices = InventoryPrice::with(['store'])->where('inventory_item_id', $id)->get();
    }
    public function render()
    {
        return view('livewire.inventory.price', ['prices'=>$this->prices, 'stores'=>$this->stores]);
    }
}
