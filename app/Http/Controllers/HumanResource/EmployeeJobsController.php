<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\EmployeeJob;
use App\Models\Store;
use DataTables;

class EmployeeJobsController extends Controller
{
    public function index()
    {
        if(count(array_intersect(session()->get('grant'), ['SU', 'employee_jobs_access']))==0)
        {
            session()->flash('error', __('global.access_denied'));
            return redirect()->back();
        }
        $search = request('search');
        if(!empty($search)){
            $data =EmployeeJob::with('store')->whereHas('employee', function($q){
                $q->where('company_id', session()->get('company_id'));
            })->paginate(15);
        }else{
            $data =EmployeeJob::with('store')->whereHas('employee', function($q){
                $q->where('company_id', session()->get('company_id'));
            })->paginate(15);
        }
        $stores = Store::where('company_id', session()->get('company_id'))->pluck('name', 'id')->toArray();
        return view('human-resource.employee-jobs', compact('data', 'search', 'stores'));

    }

    public function show($id)
    {
        if(request()->ajax()){
            $query = EmployeeJob::with(['store','position', 'report'])->where('employee_id', $id)->orderBy('updated_at','desc')->get();
            return DataTables::of($query)
            ->editColumn('store_id', function ($row){
                return isset($row->store->name)?$row->store->name:'';
            })
            ->editColumn('job_position', function ($row){
                return isset($row->position->department)?$row->position->department.'/'.$row->position->division:'';
            })
            ->editColumn('reports_to', function ($row){
                return isset($row->report->surname)?$row->report->title.' '.$row->report->surname.' '.$row->report->initials:'';
            })
            ->make(true);
        }
    }

    public function store(){
        $error = Validator::make(\request()->all(), $this->validateRules());
        if($error->fails())
        {
            session()->flash('error', __('global.error_add'));
        }else{
            $form_data = request()->all();
            EmployeeJob::create($form_data);
            session()->flash('success', __('global.record_added'));
        }

        return redirect()->back();
    }

    public function edit($id){
        $data = EmployeeJob::findOrFail($id);
        return response()->json(['data'=>$data]);
    }

    public function update($id){
        $error = Validator::make(\request()->all(), $this->validateRules());
        if($error->fails())
        {
            return response()->json($error->errors()->all());
        }
        if(request()->get('job_id'))
        {
            EmployeeJob::where('id', request()->get('job_id'))->update([
                
            ]);
        }else{
            $form_data = request()->all();
            $form_data['employee_id']=$id;
            $res =EmployeeJob::create($form_data);
        }
        return response()->json(['success'=>$res]);
    }

    public function validateRules()
    {
        $data =[
        'effective_date'=>'required',
        'job_title'=>'required',
        'store_id'=>'required',
        'job_position'=>'required',
        'reports_to'=>'required',
        // 'overtime_allowed'=>'required',
        'change_reason'=>'required',
        ];
        return $data;
    }

    public function destroy($id)
    {
        EmployeeJob::destroy($id);
        session()->flash('success', __('global.record_deleted'));
        return redirect()->back();
    }
}
