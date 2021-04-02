<?php

namespace App\Http\Livewire\Customers;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
class CustomerList extends Component
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
        $data = DB::table('customers')
        ->where('company_id', session()->get('company_id'))
        ->where(function($q){
            $q->where('account_number', 'like', "%".$this->search."%")
            ->orWhere('description', 'like', "%".$this->search."%");
        })
        ->orderBy('description')
        ->select('id', 'account_number', 'description', 'is_active')
        ->paginate($this->size);
        return view('livewire.customers.customer-list', compact('data'));
    }
}
