<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Model\Employee;

class EmployeeSearch extends Component
{
    public $field;
    public $query;
    public $result;

    public function mount($field)
    {
        $this->field = $field;
        $this->resets();
    }

    public function resets()
    {
        $this->query='';
        $this->result=[];
        

    }
    public function updatedQuery()
    {
        $this->result = Employee::where('company_id', session()->get('company_id'))
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
            ->get()
            ->toArray();
    }
    public function render()
    {
        $field = $this->field;
        return view('livewire.employee-search', compact('field'));
    }
}
