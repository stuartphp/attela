<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Validator;
use App\Models\Company;

class CompaniesController extends Controller
{
    public function index()
    {
        $data = Company::findOrFail(session()->get('company_id'));

        return view('setup.companies', compact('data'));

    }

    public function store(){
        $error = Validator::make(\request()->all(), $this->validateRules());

        if($error->fails())
        {
            return response()->json(['errors'=>$error->errors()->all()]);
        }

        $form_data = request()->all();
        if(request()->file('document_logo'))
        {
            $fileTmpPath = $_FILES['document_logo']['tmp_name'];
            $fileName = $_FILES['document_logo']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $dir = 'companies/'.session()->get('company_id').'/logo.'.$fileExtension;
            move_uploaded_file($fileTmpPath, $dir);
            $form_data['document_logo']=$dir;
        }
        Company::create($form_data);
        return redirect()->back()->with('success', __('global.record_updated'));
    }

    public function edit($id){
        $data = Company::findOrFail($id);
        return response()->json(['data'=>$data]);
    }

    public function update($id){
        $res = request()->all();

        $data = Company::findOrFail($id);
        if(request()->file('document_logo'))
        {
            $fileTmpPath = $_FILES['document_logo']['tmp_name'];
            $fileName = $_FILES['document_logo']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $dir = 'companies/'.session()->get('company_id').'/logo.'.$fileExtension;
            move_uploaded_file($fileTmpPath, $dir);
            $res['document_logo']=$dir;
        }else{
            unset($res['document_logo']);
        }

        $data->update($res);
        $data->save();
        return redirect()->back()->with('success', __('global.record_updated'));
    }

    public function validateRules()
    {
        $data =[ 'creator'=>'required',
        'trading_name'=>'required',
        'registered_as'=>'required',
        'contact_name'=>'required',
        'contact_number'=>'required',
        'email'=>'required',
        'physical_address'=>'required',
        'postal_address'=>'required',
        'document_logo' =>'mimes:gif,bmp,jpg,jpeg,png|max:850',
        ];
        return $data;
    }

    public function destroy($id)
    {
        Company::destroy($id);
        return response()->json(['success'=>'yes']);
    }
}
