<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class InventoryList extends Component
{
    use WithPagination;

    public $search = '';
    public $page = 1;
    public $size=15;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'size'
    ];

    public function render()
    {
        if($this->search>'')
        {
            $this->page=1;
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
        return view('livewire.inventory-list', compact('data'));
    }
}
