<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeNote;
use Validator;

class EmployeeNotesController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'employee_notes_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search)){
                $data =EmployeeNote::with('user')->whereHas('employee', function($q){
                    $q->where('company_id', session()->get('company_id'));
                })->paginate(15);
            }else{
                $data =EmployeeNote::with('user')->whereHas('employee', function($q){
                    $q->where('company_id', session()->get('company_id'));
                })->paginate(15);
            }
            return view('human-resource.employee-notes', compact('data', 'search'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                session()->flash('error', __('global.error_add'));
            }else{
                $form_data = request()->all();
                EmployeeNote::create($form_data);
                session()->flash('success', __('global.record_added'));
            }

            return redirect()->back();
        }

        public function edit($id){
            $data = EmployeeNote::with('employee')->findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = EmployeeNote::findOrFail($id);
            $data->update($res);
            session()->flash('success', __('global.record_updated'));
            return redirect()->back();
        }

        public function validateRules()
        {
            $data =[ 'employee_id'=>'required',
            'action_date'=>'required',
            'user_id'=>'required',
            'comment'=>'required',
            ];
            return $data;
        }

        public function destroy($id)
        {
            EmployeeNote::destroy($id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }
}
