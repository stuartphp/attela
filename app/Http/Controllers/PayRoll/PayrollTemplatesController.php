<?php

namespace App\Http\Controllers\PayRoll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\PayrollTemplate;

class PayrollTemplatesController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'payroll_template_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search)){
                $data =PayrollTemplate::paginate(15);
            }else{
                $data =PayrollTemplate::paginate(15);
            }
            return view('payroll.template', compact('data', 'search'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                session()->flash('error', __('global.error_add'));
            }else{
                $form_data = request()->all();
                PayrollTemplate::create($form_data);
                session()->flash('success', __('global.record_added'));
            }

            return redirect()->back();
        }

        public function edit($id){
            $data = PayrollTemplate::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = PayrollTemplate::findOrFail($id);
            $data->update($res);
            session()->flash('success', __('global.record_updated'));
            return redirect()->back();
        }

        public function validateRules()
        {
            $data =[ 'employee_id'=>'required',
            'tax_description'=>'required',
            'transaction_description'=>'required',
            'only_periods'=>'required',
            'nocash'=>'required',
            ];
            return $data;
        }

        public function destroy($id)
        {
            PayrollTemplate::destroy($id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }
}
