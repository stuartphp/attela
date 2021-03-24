<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\EmployeeEmergencyContact;

class EmployeeEmergencyContactsController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'employee_emergency_contacts_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search)){
                $data =EmployeeEmergencyContact::whereHas('employee', function($q){
                    $q->where('company_id', session()->get('company_id'));
                })->paginate(15);
            }else{
                $data =EmployeeEmergencyContact::whereHas('employee', function($q){
                    $q->where('company_id', session()->get('company_id'));
                })->paginate(15);
            }
            return view('human-resource.employee-emergency-contacts', compact('data', 'search'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                session()->flash('error', __('global.error_add'));
            }else{
                $form_data = request()->all();
                EmployeeEmergencyContact::create($form_data);
                session()->flash('success', __('global.record_added'));
            }

            return redirect()->back();
        }

        public function edit($id){
            $data = EmployeeEmergencyContact::with('employee')->findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = EmployeeEmergencyContact::findOrFail($id);
            $data->update($res);
            session()->flash('success', __('global.record_updated'));
            return redirect()->back();
        }

        public function validateRules()
        {
            $data =[ 'employee_id'=>'required',
            'name'=>'required',
            'email'=>'required',
            'relationship'=>'required',
            ];
            return $data;
        }

        public function destroy($id)
        {
            EmployeeEmergencyContact::destroy($id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }
}
