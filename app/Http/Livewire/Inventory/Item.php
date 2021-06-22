<?php

namespace App\Http\Livewire\Inventory;

use App\Traits\SelectInventoryCategoryTrait;
use App\Models\InventoryItem;
use App\Models\InventoryUnit;
use Livewire\Component;

class Item extends Component
{
    use SelectInventoryCategoryTrait;

    public $item_id;
    public InventoryItem $inventory_item;
    public $categories;
    public $units;
    protected $listeners = ['updItemId' ];

    public $rules =[
        'inventory_item.item_code'=>'required'
    ];
    // Model
    public $item_code, $description, $dictation, $keywords, $tags, $category_id, $barcode, $isbn_number, $unit, $commodity_code, $nett_mass_gram, $is_service, $allow_tax, $purchase_tax_type, $sales_tax_type, $is_fixed_description, $sales_commission_item, $is_active;


    public function updItemId($id)
    {
        $this->item_id=$id;
        $this->hydrateModel();

    }
    public function mount($item_id)
    {
        $this->item_id = $item_id;
    }

    public function hydrateModel()
    {
        $data = InventoryItem::findOrFail($this->item_id);
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
        $this->nett_mass_gram=$data->nett_mass;
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

        return view('livewire.inventory.item', [ 'data'=>$this->hydrateModel(), 'categories'=>$this->categories, 'units'=>$this->units]);
    }
}
