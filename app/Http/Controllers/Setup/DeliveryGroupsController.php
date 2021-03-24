<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SetupDeliveryGroup;
use DataTables;
use Validator;
class DeliveryGroupsController extends Controller
{
    public function index()
    {
        if(count(array_intersect(session()->get('grant'), ['SU', 'setup_delivery_groups_access']))==0)
        {
            session()->flash('error', __('global.access_denied'));
            return redirect()->back();
        }
        $data = SetupDeliveryGroup::where('company_id', session()->get('company_id'))->paginate(15);
        return view('setup.delivery_groups', compact('data'));

    }

    public function store(){
        $error = Validator::make(\request()->all(), $this->validateRules());
        if($error->fails())
        {
            return response()->json(['errors'=>$error->errors()->all()]);
        }
        $form_data = request()->all();
        SetupDeliveryGroup::create($form_data);
        return redirect()->back()->with(['success'=>__('global.record_added')]);
    }

    public function edit($id){
        $data = SetupDeliveryGroup::findOrFail($id);
        return response()->json(['data'=>$data]);
    }

    public function update($id){
        $error = Validator::make(\request()->all(), $this->validateRules());
        if($error->fails())
        {
            return response()->json(['errors'=>$error->errors()->all()]);
        }
        $res = request()->all();
        $data = SetupDeliveryGroup::findOrFail($id);
        $data->update($res);
        return redirect()->back()->with(['success'=>__('global.record_updated')]);
    }

    public function validateRules()
    {
        $data =[
            'company_id'=>'required',
            'name'=>'required',
            'standard_rate'=>'required',
            'standard_weight_gram'=>'required',
            'additional_cost'=>'required',
            'additional_weight_per_gram'=>'required',
        ];
        return $data;
    }

    public function destroy($id)
    {
        SetupDeliveryGroup::destroy($id);
        return response()->json(['success'=>'yes']);
    }
}
