<?php

namespace App\Http\Livewire;

use App\Models\InventoryPrice;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class TestComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $page = 1;
    public $size;
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'size'
    ];
    public $action;


    public function mount()
    {
        $this->size = 15;

    }
    public function render()
    {
        if(empty($this->size))
        {
            $this->size=15;
        }
        if(!empty($this->search))
        {
            $prices = DB::table('inventory_prices')
                ->join('stores', 'stores.id', '=', 'store_id')
                ->where('stores.company_id', session()->get('company_id'))
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
            ->select('inventory_prices.*', 'stores.name as store')
            ->paginate($this->size);
        }


        return view('livewire.test-component', compact('prices'));
    }

    public function doAction($id)
    {
        dd($this->action.' '.$id);
    }
}
