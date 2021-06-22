<?php

namespace App\Http\Livewire\Inventory;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Traits\SelectInventoryCategoryTrait;
use App\Models\InventoryUnit;

class InventoryDetail extends Component
{
    use SelectInventoryCategoryTrait;
    public $item_id=0;
    public $item_code, $description, $dictation, $keywords, $tags, $category_id, $barcode, $isbn_number, $unit, $commodity_code, $nett_mass_gram, $is_service, $allow_tax, $purchase_tax_type, $sales_tax_type, $is_fixed_description, $sales_commission_item, $is_active;
    public $categories;
    public $units;

    protected $listeners = ['getItemId'];


    public function getItemId($id)
    {
        $this->item_id=$id;
        $this->getDetail($this->item_id);
        $this->emitTo('inventory.inventory-price', 'updItemId', $id);
    }

    public function getDetail($id)
    {
        $data = DB::table('inventory_items')->where('id', $this->item_id)->first();
        $this->item_code=$data->item_code;
        $this->description=$data->description;
        $this->dictation=$data->dictation;
        $this->keywords=$data->keywords;
        $this->tags=$data->tags;
        $this->category_id=$data->category_id;
        $this->barcode=$data->barcode;
        $this->isbn_number=$data->isbn_number;
        $this->unit=$data->unit;
        $this->commodity_code=$data->commodity_code;
        $this->nett_mass_gram=$data->nett_mass_gram;
        $this->is_service=$data->is_service;
        $this->allow_tax=$data->allow_tax;
        $this->purchase_tax_type=$data->purchase_tax_type;
        $this->sales_tax_type=$data->sales_tax_type;
        $this->is_fixed_description=$data->is_fixed_description;
        $this->sales_commission_item=$data->sales_commission_item;
        $this->is_active=$data->is_active;
    }

    public function render()
    {
        $this->categories == $this->getCategory();
        $this->units = InventoryUnit::whereIn('company_id', [0, session()->get('company_id')])->orderBy('name')->pluck('name', 'name')->toArray();

        return view('livewire.inventory.inventory-detail', [
            'categories'=>$this->categories, 'units'=>$this->units
        ]);
    }
}
