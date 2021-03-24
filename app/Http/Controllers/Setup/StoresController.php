<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Validator;

class StoresController extends Controller
{
    public function index()
    {
        if(count(array_intersect(session()->get('grant'), ['SU', 'Store_access']))==0)
        {
            session()->flash('error', __('global.access_denied'));
            return redirect()->back();
        }
        $data = Store::where('company_id', session()->get('company_id'))->paginate(15);
        return view('setup.stores', compact('data'));

    }

    public function store(){
        $error = Validator::make(\request()->all(), $this->validateRules());
        if($error->fails())
        {
            return response()->json(['errors'=>$error->errors()->all()]);
        }
        $form_data = request()->all();
        Store::create($form_data);
        return redirect()->back()->with(['success'=> __('global.record_added')]);
    }

    public function show($id){

    }

    public function edit($id){
        $data = Store::findOrFail($id);
        return response()->json(['data'=>$data]);
    }

    public function update($id){
        $error = Validator::make(\request()->all(), $this->validateRules());
        if($error->fails())
        {
            return response()->json(['errors'=>$error->errors()->all()]);
        }
        $res = request()->all();
        $data = Store::findOrFail($id);
        $data->update($res);
        return redirect()->back()->with(['success'=> __('global.record_updated')]);
    }

    public function validateRules()
    {
        $data =[ 'company_id'=>'required',
        'name'=>'required',
        'is_active'=>'required',
        ];
        return $data;
    }

    public function destroy($id)
    {
        Store::destroy($id);
        return redirect()->back()->with(['success'=> __('global.record_deleted')]);
    }
}
