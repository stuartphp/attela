<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\EmployeeBenefit;
use App\Models\Employee;
use App\Models\PayrollTransactionCode;

class EmployeeBenifitsController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'employee_benefits_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }

            $data =Employee::where('company_id', session()->get('company_id'))
            ->orderBy('surname')
                ->get();

            //$transaction_codes = PayrollTransactionCode::where('company_id', session()->get('company_id'))->orderBy('transaction_description', 'asc')->get();
            return view('human-resource.benefits', compact('data'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                $err='';
                foreach($error->errors()->all() as $k=>$v){
                    $err .=trim($v)."<br>";
                }
                session()->flash('error', $err);
            }else{
                $form_data = request()->all();
                EmployeeBenefit::create($form_data);
                session()->flash('success', __('global.record_added'));
            }

            return redirect()->back();
        }

        public function edit($id){
            $data = EmployeeBenefit::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = EmployeeBenefit::findOrFail($id);
            $data->update($res);
            session()->flash('success', __('global.record_updated'));
            return redirect()->back();
        }

        public function validateRules()
        {
            $data =[
            'employee_id'=>'required',
            'transaction_id'=>'required',
            'amount'=>'required',
            'tax_percentage'=>'required',
            'tax_code'=>'required',
            'tax_description'=>'required',
            'transaction_description'=>'required',
            'retirement_fund_include'=>'required',
            'only_for_periods'=>'required',
            'no_cash'=>'required',
            ];
            return $data;
        }

        public function destroy($id)
        {
            EmployeeBenefit::destroy($id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }
}
