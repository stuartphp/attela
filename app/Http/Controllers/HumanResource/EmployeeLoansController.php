<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\EmployeeLoan;

class EmployeeLoansController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'employee_loans_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search)){
                $data =EmployeeLoan::paginate(15);
            }else{
                $data =EmployeeLoan::paginate(15);
            }
            return view('human-resource.employee-loans', compact('data', 'search'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                session()->flash('error', __('global.error_add'));
            }else{
                $form_data = request()->all();
                EmployeeLoan::create($form_data);
                session()->flash('success', __('global.record_added'));
            }

            return redirect()->back();
        }

        public function edit($id){
            $data = EmployeeLoan::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = EmployeeLoan::findOrFail($id);
            $data->update($res);
            session()->flash('success', __('global.record_updated'));
            return redirect()->back();
        }

        public function validateRules()
        {
            $data =[ 'company_id'=>'required',
            'employee_id'=>'required',
            'reference_number'=>'required',
            'issue_date'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'start_period'=>'required',
            'end_period'=>'required',
            'total_amount_due'=>'required',
            'transaction_code'=>'required',
            'balance'=>'required',
            'interest_on_amount'=>'required',
            'interest_amount'=>'required',
            'interest_transaction_code'=>'required',
            'interest_perc'=>'required',
            'paid_up'=>'required',
            'settlement_date'=>'required',
            'settlement_reason'=>'required',
            ];
            return $data;
        }

        public function destroy($id)
        {
            EmployeeLoan::destroy($id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }
}
