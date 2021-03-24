<?php

namespace App\Http\Controllers\PayRoll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\PayrollTransactionCode;

class PayrollTransactionCodesController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'payroll_transaction_codes_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search)){
                $data =PayrollTransactionCode::where('company_id', session()->get('company_id'))
                ->where('description', 'like', "%$search%")
                      ->orWhere('transaction_code', 'like', "%$search%")
                      ->orWhere('irp5_code', 'like', "%$search%")
                      ->orWhere('irp5_description', 'like', "%$search%")
                      ->orderBy('description')
                ->paginate(15);
            }else{
                $data =PayrollTransactionCode::where('company_id', 0)->orderBy('description')->paginate(15);
            }
            return view('payroll.transaction_codes', compact('data', 'search'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                session()->flash('error', $error->errors()->all());
            }else{
                $form_data = request()->all();

                $form_data['multiplier'] = (request()->get('multiplier')!='NaN') ? request()->get('multiplier')*100:100;
                PayrollTransactionCode::create($form_data);
                session()->flash('success', __('global.record_added'));
            }

            return redirect()->back();
        }

        public function edit($id){
            $data = PayrollTransactionCode::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();

            $res['multiplier'] = (request()->get('multiplier')!='NaN') ? request()->get('multiplier')*100:100;
            $data = PayrollTransactionCode::findOrFail($id);
            $data->update($res);
            session()->flash('success', __('global.record_updated'));
            return redirect()->back();
        }

        public function validateRules()
        {
            $data =[
            ];
            return $data;
        }

        public function destroy($id)
        {
            PayrollTransactionCode::destroy($id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }
}
