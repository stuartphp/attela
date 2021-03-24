<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use Validator;
use App\Models\EmployeeHoursWorked;
use App\Models\EmployeeBenefit;
use App\Models\PayrollTransactionCode;

class EmployeeHoursWorkedController extends Controller
{
    public function store()
    {
        $data = [
            'employee_id'=>\request()->get('empl_id'),
            'compensation_pay_type'=>\request()->get('compensation_pay_type'),
            'compensation_pay_schedule'=>\request()->get('compensation_pay_schedule'),
            'hours_per_day'=>\request()->get('hours_per_day')*100,
            'days_per_week'=>\request()->get('days_per_week')*100,
            'days_per_bw'=>request()->get('days_per_bw')*100,
            'ave_days_pm'=>request()->get('ave_days_pm')*100,
            'ave_hours_pw'=>request()->get('ave_hours_pw')*100,
            'ave_hours_bw'=>request()->get('ave_hours_bw')*100,
            'ave_hours_pm'=>request()->get('ave_hours_pm')*100,
            'annual_salary'=>request()->get('annual_salary')*100,
            'fixed_salary'=>request()->get('fixed_salary')*100,
            'rate_per_day'=>request()->get('rate_per_day')*100,
            'rate_per_hour'=>request()->get('rate_per_hour')*100,
            'is_advised'=>(request()->get('is_advised'))?1:0
        ];
        // Create Employee Benefit
        $payroll_code = PayrollTransactionCode::where('id', 60)->first();

        $benefit = [
            'employee_id'=>\request()->get('empl_id'),
            'payroll_transaction_code_id'=>60,
            'amount'=>request()->get('fixed_salary')*100,
            'taxable'=>$payroll_code->taxable,
            'payroll_transaction_code'=>$payroll_code->transaction_code,
            'payroll_transaction_description'=>$payroll_code->description,
            'payroll_irp5_code'=>$payroll_code->irp5_code,
            'payroll_irp5_description'=>$payroll_code->irp5_description,
            'directive_number' ,
            'directive_percentage',
            'retirement_fund_include',
            'uif_include',
            'sld_include',
            'only_for_periods',
            'no_cash',
        ];


        $id = EmployeeHoursWorked::create($data);
        if($id)
        {
            return \response()->json(['success'=>__('global.record_added'), 'id'=>$id->id, 'benefit_id'=>$ebi->id]);
        }else{
            return \response()->json(['success'=>$id->id]);
        }

    }
    public function update($id)
    {
        $data = [
            'employee_id'=>\request()->get('empl_id'),
            'compensation_pay_type'=>\request()->get('compensation_pay_type'),
            'compensation_pay_schedule'=>\request()->get('compensation_pay_schedule'),
            'hours_per_day'=>\request()->get('hours_per_day')*100,
            'days_per_week'=>\request()->get('days_per_week')*100,
            'days_per_bw'=>request()->get('days_per_bw')*100,
            'ave_days_pm'=>request()->get('ave_days_pm')*100,
            'ave_hours_pw'=>request()->get('ave_hours_pw')*100,
            'ave_hours_bw'=>request()->get('ave_hours_bw')*100,
            'ave_hours_pm'=>request()->get('ave_hours_pm')*100,
            'annual_salary'=>request()->get('annual_salary')*100,
            'fixed_salary'=>request()->get('fixed_salary')*100,
            'rate_per_day'=>request()->get('rate_per_day')*100,
            'rate_per_hour'=>request()->get('rate_per_hour')*100,
            'is_advised'=>(request()->get('is_advised'))?1:0
        ];
        $res = EmployeeHoursWorked::findOrFail($id);

        $res->update($data);
        return \response()->json(['success'=>__('global.record_updated'), 'id'=>$id]);
    }

    public function show($id)
    {
        $data = EmployeeHoursWorked::where('employee_id', $id)->first();
        return \response()->json($data);
    }
    public function validateRules()
    {

    }
}
