<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\InventoryActivity;
use Illuminate\Http\Request;
use App\Models\InventoryItem;
use App\Models\InventoryLevel;
use App\Models\InventoryOption;
use App\Models\InventoryPrice;
use App\Models\InventoryUnit;
use App\Models\InventoryImage;
use App\Models\Store;
use Validator;


use App\Traits\SelectInventoryCategoryTrait;
use Illuminate\Support\Facades\DB;

class InventoryItemsController extends Controller
{
    use SelectInventoryCategoryTrait;

    public function index()
    {
        if(count(array_intersect(session()->get('grant'), ['SU', 'inventory_items_access']))==0)
        {
            session()->flash('error', __('global.access_denied'));
            return redirect()->back();
        }
        $search = request('search');
        if(!empty($search))
        {
            $data = InventoryItem::with(['category', 'prices'])->where('company_id', session()->get('company_id'))
            ->where(function($q) use($search){
                $q->where('item_code', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('unit', 'like', "%$search%");
            })->orderBy('description')
            ->paginate(17);
        }else{
            $data = InventoryItem::with(['category', 'prices'])->where('company_id', session()->get('company_id'))->orderBy('description')
            ->paginate(17);
        }

        return view('inventory.items', compact( 'data', 'search'));

    }
    public function create()
    { 
        $data = (object) [];
        $cats = $this->getCategory();
        $units = InventoryUnit::whereIn('company_id', [0, session()->get('company_id')])->orderBy('name')->pluck('name', 'name')->toArray();
        return view('inventory.form_items', compact('data', 'cats','units'));
    }

    public function store(){
        $error = Validator::make(\request()->all(), $this->validateRules());

        if($error->fails())
        {
            return response()->json([$error->errors()->all()]);
        }else{
            $form_data = request()->all();
            $form_data['company_id'] = session()->get('company_id');
            $form_data['allow_tax'] = request()->get('allow_tax')?1:0;
            $form_data['is_service'] = request()->get('is_service')?1:0;
            $form_data['is_fixed_description'] = request()->get('is_fixed_description')?1:0;
            $form_data['sales_commission_item'] = request()->get('sales_commission_item')?1:0;
            $form_data['is_active'] = request()->get('is_active')?1:0;
            $id = InventoryItem::create($form_data);
            //return response()->json(['success'=>['id'=>$id->id, 'is_active'=>$form_data['is_active']]]);
            return \redirect()->back()->with(['success'=>__('global.record_added')]);
        }
    }

    public function show($id){
        $data = InventoryItem::findOrFail($id);
        $cats = $this->getCategory($data->category_id);
        $units = InventoryUnit::whereIn('company_id', [0, session()->get('company_id')])->orderBy('name')->pluck('name', 'name')->toArray();
        $prices = InventoryPrice::where('inventory_item_id', $id)->get();
// 
        $options = InventoryOption::where('inventory_item_id', $id)->orderBy('name')->get();
        $level = InventoryLevel::where('inventory_item_id', $id)->get();
        $images = InventoryImage::where('inventory_item_id', $id)->get();
        $stores= Store::where('company_id', session()->get('company_id'))->pluck('name', 'id')->toArray();
        //$activities = InventoryActivity::where('inventory_item_id', $id)->paginate(10);, 'activities'
        return view('inventory.detail', compact('data', 'cats','units', 'prices', 'options', 'level', 'images', 'stores'));
    }

    public function update($id){
        $error = Validator::make(\request()->all(), $this->validateRules());

        if($error->fails())
        {
            return response()->json([$error->errors()->all()]);
        }else{
            $form_data = request()->all();
            $form_data['allow_tax'] = request()->get('allow_tax')?1:0;
            $form_data['is_service'] = request()->get('is_service')?1:0;
            $form_data['is_fixed_description'] = request()->get('is_fixed_description')?1:0;
            $form_data['sales_commission_item'] = request()->get('sales_commission_item')?1:0;
            $form_data['is_active'] = request()->get('is_active')?1:0;
            $data = InventoryItem::findOrFail($id);
            $data->update($form_data);
            return response()->json(['success'=>['is_active'=>$form_data['is_active']]]);
        }
    }

    public function validateRules()
    {
        $data =[
        'item_code'=>'required',
        'description'=>'required',
        'category_id'=>'required',
        'unit'=>'required',
        // 'is_service'=>'required',
        // 'allow_tax'=>'required',
        'purchase_tax_type'=>'required',
        'sales_tax_type'=>'required',
        // 'is_fixed_description'=>'required|min:1',
        // 'sales_commission_item'=>'required|min',
        // 'is_active'=>'required',
        ];
        return $data; 
    }

    public function destroy($id)
    {
        InventoryItem::destroy($id);
        session()->flash('success', __('global.record_deleted'));
        return redirect()->back();
    }
}
