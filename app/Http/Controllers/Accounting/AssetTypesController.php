<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssetType;
use Validator;

class AssetTypesController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'asset_types_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $data = AssetType::where('company_id', session()->get('company_id'))->paginate(15);
            return view('accounting.asset-types', compact('data'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());

            if($error->fails())
            {
                session()->flash('error', __('global.error_add'));
            }else{
                $form_data = request()->all();
                AssetType::create($form_data);
                session()->flash('success', __('global.record_added'));
            }

            return redirect()->back();
        }

        public function edit($id){
            $data = AssetType::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = AssetType::findOrFail($id);
            $data->update($res);
            session()->flash('success', __('global.record_updated'));
            return redirect()->back();
        }

        public function validateRules()
        {
            $data =[ 'company_id'=>'required',
                'asset_group_id'=>'required',
                'name'=>'required',
            ];
            return $data;
        }

        public function destroy($id)
        {
            AssetType::destroy($id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }
}
