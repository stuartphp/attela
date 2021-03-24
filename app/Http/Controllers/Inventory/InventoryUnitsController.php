<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryUnit;
use Validator;


class InventoryUnitsController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'inventory_units_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search))
            {
                $data = InventoryUnit::whereIn('company_id', [0,session()->get('company_id')])
                ->where('name', 'like', "%$search%")
                ->orderBy('name')->paginate(15);
            }else{
                $data = InventoryUnit::whereIn('company_id', [0,session()->get('company_id')])->orderBy('name')->paginate(15);
            }
            return view('inventory.units', compact('data', 'search'));

        }
       
        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());

            if($error->fails())
            {
                return response()->json(['errors'=>$error->errors()->all()]);
            }
            $form_data =  request()->all();
            $form_data['name']=strtoupper(request()->get('name'));
            if(request()->get('all_companies')==1)
            {
                $form_data['company_id']=0;
            }
            InventoryUnit::create($form_data);
            return response()->json(['success'=>'yes']);
        }

        public function edit($id){
            $data = InventoryUnit::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $data = InventoryUnit::findOrFail($id);
            $form_data = request()->all();
            if(request()->get('all_companies')==1)
            {
                $form_data['company_id']=0;
            }
            $form_data['name']=strtoupper(request()->get('name'));
            $data->update($form_data);
            return response()->json('success');
        }

        public function validateRules()
        {
            $data =[ 'company_id'=>'required',
                'name'=>'required',
            ];
            return $data;
        }

        public function destroy($id)
        {
            InventoryUnit::destroy($id);
            return response()->json(['success'=>'yes']);
        }
}
