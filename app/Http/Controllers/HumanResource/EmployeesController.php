<?php

namespace App\Http\Controllers\HumanResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Traits\SelectPositionTrait;
use App\Models\EmployeeJob;
use App\Models\EmployeePaymentDetail;

class EmployeesController extends Controller
{
    use SelectPositionTrait;

    public function index()
    {
        $search =request('search');
        if(!empty($search))
        {
            $data = Employee::where('company_id', session()->get('company_id'))
                ->where(function($q) use($search){
                    $q->where('employee_code', 'like', "%$search%")
                      ->orWhere('title', 'like', "%$search%")
                      ->orWhere('surname', 'like', "%$search%")
                      ->orWhere('first_name', 'like', "%$search%")
                      ->orWhere('second_name', 'like', "%$search%")
                      ->orWhere('known_as', 'like', "%$search%")
                      ->orWhere('id_number', 'like', "%$search%")
                      ->orWhere('date_of_birth', 'like', "%$search%");
                })
                ->orderBy('surname')->paginate(15);
        }else{
            $data = Employee::where('company_id', session()->get('company_id'))->orderBy('surname')->paginate(15);
        }

        return view('human-resource.employees', compact('data'));
    }
    public function show($id)
    {
        $data = Employee::findOrFail($id);

        $countries = Country::orderBy('name')->pluck('name', 'iso_code_3')->toarray();
        $documents = EmployeeDocument::where('employee_id', $id)->get();
        //$positions = EmployeeJob::with(['report', 'position'])->where('employee_id', $id)->orderBy('end_date', 'asc')->get();
        $payment_detail = EmployeePaymentDetail::with('employee')->where('employee_id', $id)->first();
        $position_select = $this->getCategory();
        return view('human-resource.detail', compact('data', 'position_select','countries', 'documents', 'payment_detail'));
    }

    public function image()
    {
        $getImage = Employee::findOrFail(\request()->get('id'));
        $dir = 'companies/'.session()->get('company_id').'/employees/';
        if($getImage->image > '')
        {
            // Delete Image
            \unlink($dir.$getImage->image);
        }
        $file = request()->file('file_name');
        $nuName = time().'.'.$file->extension();

        $dir = $dir.$nuName;
        if(move_uploaded_file($_FILES["file_name"]["tmp_name"], $dir)){
            $form_data['file_name']=$dir;
            $getImage->image = $nuName;
            $getImage->save();
            return response()->json(['success'=>$nuName]);
        }else{
            return response()->json(['error'=>__('global.upload_error')]);
        }
    }
}
