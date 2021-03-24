<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeave;
use Illuminate\Http\Request;
use Validator;
use DataTables;
use App\Models\EmployeeLeaveRegister;

class EmployeeLeaveRegistersController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'employee_leave_registers_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search)){
                $data =EmployeeLeaveRegister::whereHas('employee', function($q) use($search){
                    $q->where('company_id', session()->get('company_id'))
                        ->where(function($r) use ($search){
                            $r->where('employee_code', 'like', "%$search%")
                                ->orWhere('surname', 'like', "%$search%")
                                ->orWhere('first_name', 'like', "%$search%")
                                ->orWhere('second_name', 'like', "%$search%");
                        });
                })->paginate(15);
            }else{
                $data =EmployeeLeaveRegister::whereHas('employee', function($q){
                    $q->where('company_id', session()->get('company_id'));
                })->paginate(15);
            }
            return view('human-resource.employee-leave-registers', compact('data', 'search'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                session()->flash('error', __('global.error_add'));
            }else{
                $form_data = request()->all();
                EmployeeLeaveRegister::create($form_data);
                // Update Leave
                @EmployeeLeave::where('employee_id', request('employee_id'))
                ->where('type', request('leave_type'))
                ->decrement('balance', request('total_days'));
                
                session()->flash('success', __('global.record_added'));
            }

            return redirect()->back();
        }

        public function edit($id){
            $data = EmployeeLeaveRegister::with('employee')->findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = EmployeeLeaveRegister::findOrFail($id);
            $data->update($res);
            session()->flash('success', __('global.record_updated'));
            return redirect()->back();
        }
        public function show($id){
            if(request()->ajax()){
                $query = EmployeeLeaveRegister::where('employee_id', $id)->get();
                return DataTables::of($query)
                ->editColumn('leave_type', function ($row){
                    return isset($row->leave_type)? __('employee_lookup.leave.'.$row->leave_type):'';
                })
                ->make(true);
            }
        }
        public function validateRules()
        {
            $data =[
            'employee_id'=>'required',
            'leave_type'=>'required',
            'from_date'=>'required',
            'to_date'=>'required',
            'total_days'=>'required',
            'reason'=>'required',
            ];
            return $data;
        }

        public function destroy($id)
        {
            EmployeeLeaveRegister::destroy($id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }
}
