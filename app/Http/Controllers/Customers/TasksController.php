<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerTask;
use DataTables;
use Validator;
class TasksController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'customer_tasks_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search))
            {
                $data = CustomerTask::whereHas('customers', function ($q){
                    $q->where('company_id', session()->get('company_id'));
                })->where(function($q) use($search){
                    $q->where('activity', 'like', "%$search%");
                })
                ->paginate(15);

            }else{
                $data = CustomerTask::whereHas('customers', function ($q){ $q->where('company_id', session()->get('company_id'));})->paginate(15);
            }
            return view('customers.tasks', compact('data', 'search'));

        }
        
        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());

            if($error->fails())
            {
                return response()->json(['errors'=>$error->errors()->all()]);
            }

            $form_data = request()->all();

            CustomerTask::create($form_data);
            return response()->json(['success'=>'yes']);
        }

        public function edit($id){
            $data = CustomerTask::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = CustomerTask::findOrFail($id);
            $data->update($res);
            return response()->json('success');
        }

        public function validateRules()
        {
            $data =[ 'customer_id'=>'required',
'action_date'=>'required',
'title'=>'required',
'customer_contact_id'=>'required',
'deadline'=>'required',
'status'=>'required',
'user_id'=>'required',
'assigned_to'=>'required',
 ];
            return $data;
        }

        public function destroy($id)
        {
            CustomerTask::destroy($id);
            return response()->json(['success'=>'yes']);
        }
}
