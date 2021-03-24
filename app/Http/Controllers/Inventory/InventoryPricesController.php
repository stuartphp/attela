<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\InventoryLevel;
use Illuminate\Http\Request;
use App\Models\InventoryPrice;
use Illuminate\Validation\Rules\In;
use Validator;
class InventoryPricesController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'inventory_prices_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search))
            {
                $data = InventoryPrice::whereHas('items', function ($q) use($search){
                    $q->where('company_id', session()->get('company_id'))
                    ->where('item_code', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('unit', 'like', "%$search%");
                })->with(['store'])->paginate(15);
            }else{
                $data = InventoryPrice::whereHas('items', function ($q){
                    $q->where('company_id', session()->get('company_id'));
                })->with(['store'])->paginate(15);
            }
            
            return view('inventory.prices', compact('data', 'search'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                return response()->json([$error->errors()->all()]);
            }else{
                $form_data = request()->all();
                // Check if store has a level
                $check = InventoryPrice::where('inventory_item_id', $form_data['inventory_item_id'])->where('store_id', $form_data['store_id'])->first();
                if($check)
                {
                    return response()->json(['error'=> ['Only one price per store allowed']]);
                }else{
                    $id =InventoryPrice::create($form_data);
                    $html = $this->html($id->id);
                    return response()->json(['success'=>$html]);
                 }
            }
        }

        public function edit($id){
            $data = InventoryPrice::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                return response()->json([$error->errors()->all()]);
            }else{
                $form_data = request()->all();
                $data = InventoryPrice::findOrFail($id);
                $data->update($form_data);

                $html = $this->html($id);
                return response()->json(['success'=>$html]);
            }
        }

        public function validateRules()
        {
            $data =[ 'inventory_item_id'=>'required',
            'store_id'=>'required',
            'retail'=>'required',
            ];
            return $data;
        }

        public function html($id)
        {
            // Add security
            $res = InventoryPrice::with('store')->findOrFail($id);

            $html = '<tr id="pri_r_'.$res->id.'">
            <td>'.$res->store->name.'</td>
            <td>'.number_format($res->cost_price,2).'</td>
            <td>'.number_format($res->retail,2).'</td>
            <td>'.number_format($res->dealer,2).'</td>
            <td>'.number_format($res->whole_sale,2).'</td>
            <td>'.number_format($res->price_list1,2).'</td>
            <td>'.number_format($res->price_list2,2).'</td>
            <td>'.number_format($res->price_list3,2).'</td>
            <td>'.number_format($res->price_list4,2).'</td>
            <td>'.number_format($res->price_list5,2).'</td>
            <td>'.number_format($res->special,2).'</td>
            <td>'.$res->special_from.'</td>
            <td>'.$res->special_to.'</td>
            <td><select class="inv_price_action form-select" id="pri_'.$res->inventory_item_id.'_'.$res->id.'"><option value="">'. __('global.select').'</option><option value="Edit">'. __('global.edit').'</option><option value="Delete">'.__('global.delete').'</option></select></td></tr>';
            return $html;
        }
        public function destroy($id)
        {
            InventoryPrice::destroy($id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }
}
