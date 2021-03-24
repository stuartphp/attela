<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\EmployeeLeave;

class EmployeeLeavesController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'employee_leaves_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search)){
                $data =EmployeeLeave::paginate(15);
            }else{
                $data =EmployeeLeave::whereHas('employee', function($q){
                    $q->where('company_id', session()->get('company_id'));
                })->paginate(15);
            }
            return view('human-resource.employee-leaves', compact('data', 'search'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                session()->flash('error', __('global.error_add'));
            }else{
                $form_data = request()->all();
                EmployeeLeave::create($form_data);
                session()->flash('success', __('global.record_added'));
            }

            return redirect()->back();
        }

        public function edit($id){
            $data = EmployeeLeave::with('employee')->findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = EmployeeLeave::findOrFail($id);
            $data->update($res);
            session()->flash('success', __('global.record_updated'));
            return redirect()->back();
        }

        public function validateRules()
        {
            $data =[
            'employee_id'=>'required',
            'balance'=>'required',
            'days_accrued'=>'required',
            'type'=>'required',
            'cycle'=>'required',
            ];
            return $data;
        }

        public function show($id){
            if(request()->ajax()){
                $query = EmployeeLeave::where('employee_id', $id)->get();
                return DataTables::of($query)
                ->editColumn('type', function ($row){
                    return isset($row->type)? __('employee_lookup.leave.'.$row->type):'';
                })
                ->make(true);
            }
        }
        public function destroy($id)
        {
            EmployeeLeave::destroy($id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }

        public function get_leave($id)
        {
            $res = EmployeeLeave::where('employee_id', $id)->get();
            $data = '';
            foreach($res as $r)
            {
                $data .="".__('employee_lookup.leave.'.$r->type)." ( ".$r->balance." )<br>";
            }
            return response()->json($data);
        }
}
