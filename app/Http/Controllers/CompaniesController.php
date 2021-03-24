<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use DataTables;
use Validator;
class CompaniesController extends Controller
{
    public function store(){
        $error = Validator::make(\request()->all(), $this->validateRules());

        if($error->fails())
        {
            return response()->json(['errors'=>$error->errors()->all()]);
        }

        $form_data = request()->all();

        Company::create($form_data);
        return redirect()->back();
    }

    public function edit($id){
        $data = Company::findOrFail($id);
        return response()->json(['data'=>$data]);
    }

    public function update($id){
        $res = request()->all();
        $data = Company::findOrFail($id);
        $data->update($res);
        return response()->json('success');
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
];
        return $data;
    }

    public function destroy($id)
    {
        Company::destroy($id);
        return response()->json(['success'=>'yes']);
    }
}
