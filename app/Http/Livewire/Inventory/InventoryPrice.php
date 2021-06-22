<?php

namespace App\Http\Livewire\Inventory;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use App\Models\InventoryPrice as PriceModel;

class InventoryPrice extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $page = 1;
    public $size;
    public $stores;
    public $item_id;
    //Modal
    public $formTitle, $formAction, $formButton;

    // Model
    public $inventory_item_id
    ,$store_id
    ,$cost_price
    ,$retail
    ,$dealer
    ,$whole_sale
    ,$price_list1
    ,$price_list2
    ,$price_list3
    ,$price_list4
    ,$price_list5
    ,$special
    ,$special_from
    ,$special_to;

    // Rules
    public $rules = [
        'store_id' => 'required',
        'retail' =>'required'
    ];

    protected $listeners = ['updItemId' ];

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'size'
    ];

    public function updItemId($id)
    {
        $this->item_id=$id;
    }

    public function mount($item_id)
    {
        $this->formTitle = __('global.add_new_record');
        $this->formButton = __('global.save');
        $this->size = 15;
        $this->item_id=$item_id;
        $this->stores = DB::table('stores')->where('company_id', session()->get('company_id'))->orderBy('name')->pluck('name', 'id')->toArray();
    }

    public function priceAction($val, $id)
    {
        switch($val)
        {
            case 'Add':
                $this->inventory_item_id='';
                $this->store_id='';
                $this->cost_price='';
                $this->retail='';
                $this->dealer='';
                $this->whole_sale='';
                $this->price_list1='';
                $this->price_list2='';
                $this->price_list3='';
                $this->price_list4='';
                $this->price_list5='';
                $this->special='';
                $this->special_from='';
                $this->special_to='';
                $this->formTitle=__('global.add_new_record');
                $this->formAction='add';
                $this->formButton=__('global.save');
                $this->dispatchBrowserEvent('modal', ['modal'=>'priceModal', 'action'=>'show']);
                break;
            case 'Delete':

                break;
            default:
                $data =PriceModel::findOrFail($id);
                $this->inventory_item_id=$data->inventory_item_id;
                $this->store_id=$data->store_id;
                $this->cost_price=$data->cost_price;
                $this->retail=$data->retail;
                $this->dealer=$data->dealer;
                $this->whole_sale=$data->whole_sale;
                $this->price_list1=$data->price_list1;
                $this->price_list2=$data->price_list2;
                $this->price_list3=$data->price_list3;
                $this->price_list4=$data->price_list4;
                $this->price_list5=$data->price_list5;
                $this->special=$data->special;
                $this->special_from=$data->special_from;
                $this->special_to=$data->special_to;
                $this->formTitle=__('global.edit');
                $this->formAction='edit';
                $this->formButton=__('global.update');
                $this->dispatchBrowserEvent('modal', ['modal'=>'priceModal', 'action'=>'show']);
                break;
        }
    }

    public function priceCrud()
    {
        $this->validate();
        switch($this->formAction)
        {
            case 'edit':
                session()->flash('success', 'Updated');
                break;
        }
    }


    public function render()
    {
        if(!empty($this->search))
        {
            $prices = DB::table('inventory_prices')
                ->join('stores', 'stores.id', '=', 'store_id')
                ->where('stores.company_id', session()->get('company_id'))
                ->where('inventory_item_id', $this->item_id)
                ->where(function($q){
                     $q->where('stores.name', 'like', "%".$this->search."%")
                        ->orWhere('cost_price', 'like', "%".$this->search."%")
                        ->orWhere('retail', 'like', "%".$this->search."%")
                        ->orWhere('dealer', 'like', "%".$this->search."%")
                        ->orWhere('whole_sale', 'like', "%".$this->search."%")
                        ->orWhere('price_list1', 'like', "%".$this->search."%")
                        ->orWhere('price_list2', 'like', "%".$this->search."%")
                        ->orWhere('price_list3', 'like', "%".$this->search."%")
                        ->orWhere('price_list4', 'like', "%".$this->search."%")
                        ->orWhere('price_list5', 'like', "%".$this->search."%")
                        ->orWhere('special', 'like', "%".$this->search."%");
                })
                ->select('inventory_prices.*', 'stores.name as store')
                ->paginate($this->size);

        }else{
            $prices = $prices = DB::table('inventory_prices')
            ->join('stores', 'stores.id', '=', 'store_id')
            ->where('stores.company_id', session()->get('company_id'))
            ->where('inventory_item_id', $this->item_id)
            ->select('inventory_prices.*', 'stores.name as store')
            ->paginate($this->size);
        }

        return view('livewire.inventory.inventory-price', ['prices'=>$prices, 'stores'=>$this->stores]);
    }

}
