<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DataTables;
use App\Models\EmployeeDisciplinaryAction;

class EmployeeDisciplinaryActionsController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'employee_disciplanary_actions_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search)){
                $data =EmployeeDisciplinaryAction::paginate(15);
            }else{
                $data =EmployeeDisciplinaryAction::with(['reason', 'employee'])
                ->whereHas('employee',function($q){
                    $q->where('company_id', session()->get('company_id'));
                })
                ->paginate(15);
            }
            
            return view('human-resource.employee-disciplinary-actions', compact('data', 'search'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                session()->flash('error', __('global.error_add'));
            }else{
                $form_data = request()->all();
                EmployeeDisciplinaryAction::create($form_data);
                session()->flash('success', __('global.record_added'));
            }

            return redirect()->back();
        }

        public function edit($id){
            $data = EmployeeDisciplinaryAction::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = EmployeeDisciplinaryAction::findOrFail($id);
            $data->update($res);
            session()->flash('success', __('global.record_updated'));
            return redirect()->back();
        }

        public function show($id){
            if(request()->ajax()){
                $query = EmployeeDisciplinaryAction::where('employee_id', $id)->get();
                return DataTables::of($query)
                // ->editColumn('type', function ($row){
                //     return isset($row->type)? __('employee_lookup.leave.'.$row->type):'';
                // })
                ->make(true);
            }
        }

        public function validateRules()
        {
            $data =[ 'employee_id'=>'required',
        'action_date'=>'required',
        'incident'=>'required',
        'action_code'=>'required',
        'expire_date'=>'required',
 ];
            return $data;
        }

        public function destroy($id)
        {
            EmployeeDisciplinaryAction::destroy($id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }
}
