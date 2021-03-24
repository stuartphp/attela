<?php

namespace App\Http\Controllers\PayRoll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\PayrollTransaction;

class PayrollTransactionsController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'payroll_transactions_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search)){
                $data =PayrollTransaction::paginate(15);
            }else{
                $data =PayrollTransaction::paginate(15);
            }
            return view('payroll.transactions', compact('data', 'search'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                session()->flash('error', __('global.error_add'));
            }else{
                $form_data = request()->all();
                PayrollTransaction::create($form_data);
                session()->flash('success', __('global.record_added'));
            }

            return redirect()->back();
        }

        public function edit($id){
            $data = PayrollTransaction::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = PayrollTransaction::findOrFail($id);
            $data->update($res);
            session()->flash('success', __('global.record_updated'));
            return redirect()->back();
        }

        public function validateRules()
        {
            $data =[ 'employee_id'=>'required',
            'transaction_period'=>'required',
            'tax_description'=>'required',
            'transaction_description'=>'required',
            'payslip'=>'required',
            'posted'=>'required',
            'company_id'=>'required',
            ];
            return $data;
        }

        public function destroy($id)
        {
            PayrollTransaction::destroy($id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }
}
