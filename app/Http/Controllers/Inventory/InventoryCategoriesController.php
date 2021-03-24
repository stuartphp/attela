<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryCategory;
use Validator;

class InventoryCategoriesController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'inventory_categories_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search))
            {
                $data = InventoryCategory::where('company_id', session()->get('company_id'))
                ->where(function($q) use($search){
                    $q->where('main_category', 'like', "%$search")
                    ->orWhere('sub_category', 'like', "%$search");
                })
                ->orderBy('main_category', 'asc')->paginate(15);

            }else{
                $data = InventoryCategory::where('company_id', session()->get('company_id'))->orderBy('main_category', 'asc')->paginate(15);
            }
            $main = InventoryCategory::where('company_id', session()->get('company_id'))->select('main_category')->groupBy('main_category')->pluck('main_category', 'main_category')->toArray();
            return view('inventory.categories', compact('main','data', 'search'));

        }
        
        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());

            if($error->fails())
            {
                return response()->json(['errors'=>$error->errors()->all()]);
            }

            $form_data = request()->all();

            InventoryCategory::create($form_data);
            return response()->json(['success'=>'yes']);
        }

        public function edit($id){
            $data = InventoryCategory::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = InventoryCategory::findOrFail($id);
            $data->update($res);
            return response()->json('success');
        }

        public function validateRules()
        {
            $data =[ 'company_id'=>'required',
'main_category'=>'required',
'is_active'=>'required',
 ];
            return $data;
        }

        public function destroy($id)
        {
            InventoryCategory::destroy($id);
            return response()->json(['success'=>'yes']);
        }
}
