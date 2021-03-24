<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class EmployeeList extends Component
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
        $data = DB::table('employees')
        ->where('company_id', session()->get('company_id'))
        ->where(function($q){
            $q->where('employee_code', 'like', "%".$this->search."%")
            ->orWhere('first_name', 'like', "%".$this->search."%")
            ->orWhere('second_name', 'like', "%".$this->search."%")
            ->orWhere('known_as', 'like', "%".$this->search."%")
            ->orWhere('id_number', 'like', "%".$this->search."%")
            ->orWhere('passport_number', 'like', "%".$this->search."%")
            ->orWhere('surname', 'like', "%".$this->search."%");
        })
        ->orderBy('surname')
        ->select('id', 'employee_code', 'surname', 'initials', 'is_active')
        ->paginate($this->size);
        return view('livewire.employee-list', compact('data'));
    }
}
