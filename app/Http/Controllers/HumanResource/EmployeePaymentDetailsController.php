<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\EmployeePaymentDetail;

class EmployeePaymentDetailsController extends Controller
{
    public function index()
    {
        if(count(array_intersect(session()->get('grant'), ['SU', 'employee_payment_details_access']))==0)
        {
            session()->flash('error', __('global.access_denied'));
            return redirect()->back();
        }
        $search = request('search');
        if(!empty($search)){
            $data =EmployeePaymentDetail::paginate(15);
        }else{
            $data =EmployeePaymentDetail::whereHas('employee', function($q){
                $q->where('company_id', session()->get('company_id'));
            })->paginate(15);
        }
        return view('human-resource.employee-payment-details', compact('data', 'search'));

    }

    public function store(){
        $error = Validator::make(\request()->all(), $this->validateRules());
        if($error->fails())
        {
            dd($error->errors()->all());
            session()->flash('error', __('global.error_add'));
        }else{
            $form_data = request()->all();
            EmployeePaymentDetail::create($form_data);
            session()->flash('success', __('global.record_added'));
        }

        return redirect()->back();
    }

    public function edit($id){
        $data = EmployeePaymentDetail::with('employee')->findOrFail($id);
        return response()->json(['data'=>$data]);
    }

    public function update($id){
        $res = request()->all();

        if($id>0){
            $data = EmployeePaymentDetail::findOrFail($id);
            $data->update($res);
            return response()->json(['success'=>'yes']);
        }else{
            EmployeePaymentDetail::create($res);
            return response()->json(['success'=>'yes']);
        }
    }

    public function validateRules()
    {
        $data =[ 'employee_id'=>'required',
        'payslip_language'=>'required',
        'bank_branch_code'=>'required',
        'bank_name'=>'required',
        'account_number'=>'required',
        'account_holder'=>'required',
        'account_holder_relationship'=>'required',
        'account_holder_id_number'=>'required',
        'account_type'=>'required',
        'is_foreign_account'=>'required',
        ];
        return $data;
    }

    public function destroy($id)
    {
        EmployeePaymentDetail::destroy($id);
        session()->flash('success', __('global.record_deleted'));
        return redirect()->back();
    }
}
