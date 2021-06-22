<?php

namespace App\Http\Livewire\Inventory;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class InventoryList extends Component
{
    use WithPagination;

    public $search = '';
    public $page = 1;
    public $size=15;
    public $item_id=null;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'size'
    ];
    public function mount()
    {
        $this->size = (session()->has('pagination')) ? session()->get('pagination') : 15;
    }

    public function render()
    {
        if($this->size > 0)
        {
            session()->put('pagination', $this->size);
        }
        $data = DB::table('inventory_items')
        ->where('company_id', session()->get('company_id'))
        ->where(function($q){
            $q->where('item_code', 'like', "%".$this->search."%")
            ->orWhere('description', 'like', "%".$this->search."%");
        })
        ->orderBy('description')
        ->select('id', 'item_code', 'description', 'is_active')
        ->paginate($this->size);
        return view('livewire.inventory.inventory-list', compact('data'));
    }
}
