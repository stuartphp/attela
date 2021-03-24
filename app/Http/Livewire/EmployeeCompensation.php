<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class EmployeeCompensation extends Component
{
    public $employee_id;
    public $compensation_pay_type;
    public $compensation_pay_schedule;
    public $hours_per_week;
    public $days_per_week;
    public $hours_per_bw;
    public $days_per_bw;
    public $ave_days_pm;
    public $annual_salary;
    public $fixed_salary;
    public $rate_per_day;
    public $rate_per_hour;
    public $is_advised;
    public $data=[];

    public function mount($id)
    {
        $this->employee_id=$id;
        $this->data = DB::table('employee_hours_worked')->where('employee_id', $this->employee_id)->get()->toArray();
        dd($this->data);
    }

    public function render()
    {
        return view('livewire.employee-compensation', ['comp'=>$this->data]);
    }
}
