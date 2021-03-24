<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryActivity;
use App\Models\Store;
use Illuminate\Support\Facades\DB;
use Validator;
use DataTables;

class InventoryActivitiesController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'inventory_activities_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $stores = Store::where('company_id', session()->get('company_id'))->pluck('name', 'id')->toArray();
            $search = request('search');
            if(!empty($search))
            {
                $data = InventoryActivity::whereHas('items', function ($q) use($search){
                    $q->where('company_id', session()->get('company_id'));
                    //->orWhere('item_code', 'like', "%$search%");
                    })
                    ->where(function($q) use($search){
                        $q->where('document_reference', 'like', "%$search%");
                    })
                    ->with(['store'])
                    //->toSql();
                    ->paginate(20);
            }else{
                $data = InventoryActivity::whereHas('items', function ($q){
                    $q->where('company_id', session()->get('company_id'));
                })->with(['store'])->paginate(20);
            }
            //dd($data);
            return view('inventory.activities', compact('data', 'search', 'stores'));

        }
        public function get_data($id){
            if(request()->ajax()){
                $query = InventoryActivity::with(['store'])->where('inventory_item_id', $id)->orderBy('updated_at','desc')->get();
                return DataTables::of($query)
                ->editColumn('store_id', function ($row){
                    return isset($row->store->name)?$row->store->name:'';
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
                InventoryActivity::create($form_data);
                session()->flash('success', __('global.record_added'));
            }

            return redirect()->back();
        }

        public function show($id){
            $stores = Store::where('company_id', session()->get('company_id'))->pluck('name', 'id')->toArray();
            //$data = InventoryActivity::where('inventory_item_id', $id)->paginate(15);
            $data=DB::table('inventory_activities')
                ->join('stores', 'stores.id', '=', 'inventory_activities.store_id')
                ->join('inventory_items', 'inventory_items.id', '=', 'inventory_activities.inventory_item_id')
                ->where('inventory_item_id', $id)
                ->select('inventory_activities.*', 'stores.name as store', 'inventory_items.description as item')
                ->paginate(15);
            return view('inventory.form_activities', compact('data', 'stores'));
        }

        public function edit($id){
            $data = InventoryActivity::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = InventoryActivity::findOrFail($id);
            $data->update($res);
            session()->flash('success', __('global.record_updated'));
            return redirect()->back();
        }

        public function validateRules()
        {
            $data =[ 'company_id'=>'required',
            'inventory_item_id'=>'required',
            'action_date'=>'required',
            'action'=>'required',
            'store_id'=>'required',
            ];
            return $data;
        }

        public function destroy($id)
        {
            InventoryActivity::destroy($id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }
}
