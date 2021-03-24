<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\EmployeeDocument;

class EmployeeDocumentsController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'employee_documents_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search)){
                $data =EmployeeDocument::whereHas('employee', function($q){
                    $q->where('company_id', session()->get('company_id'));
                })->paginate(15);
            }else{
                $data =EmployeeDocument::whereHas('employee', function($q){
                    $q->where('company_id', session()->get('company_id'));
                })->paginate(15);
            }
            return view('human-resource.employee-documents', compact('data', 'search'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                return response()->json($error->errors()->all());
            }else{
                $form_data = request()->all();
                $form_data['user_id']=\Auth::user()->id;
                $file = request()->file('file_name');
                $nuName = time().$file->getClientOriginalName();
                $dir = 'companies/'.session()->get('company_id').'/documents/'.$nuName;
                if(move_uploaded_file($_FILES["file_name"]["tmp_name"], $dir)){
                    $form_data['file_name']=$dir;
                    $res=EmployeeDocument::create($form_data);
                    return response()->json(['success'=>$res]);
                }else{
                    return response()->json(['error'=>'upload error']);
                }
            }
        }

        public function edit($id){
            $data = EmployeeDocument::with('employee')->findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = EmployeeDocument::findOrFail($id);
            $data->update($res);
            session()->flash('success', __('global.record_updated'));
            return redirect()->back();
        }

        public function validateRules()
        {
            $data =[ 'employee_id'=>'required',
            'document_type'=>'required',
            'file_name'=>'required',
            ];
            return $data;
        }

        public function destroy($id)
        {
            EmployeeDocument::destroy($id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }
}
