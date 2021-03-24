<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\InventoryActivity;
use Illuminate\Http\Request;
use App\Models\InventoryLevel;
use Validator;

class InventoryLevelsController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'inventory_levels_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search))
            {
                $data = InventoryLevel::whereHas('items', function ($q) use($search){
                    $q->where('company_id', session()->get('company_id'))
                    ->where('item_code', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('unit', 'like', "%$search%");
                })->with(['store'])->paginate(15);
            }else{
                $data = InventoryLevel::whereHas('items', function ($q){
                    $q->where('company_id', session()->get('company_id'));
                })->with(['store'])->paginate(15);
            }
            return view('inventory.levels', compact('data', 'search'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());

            if($error->fails())
            {
                return response()->json(['error'=> $error->errors()->all()]);
            }else{
                $form_data = request()->all();
                // Check if store has a level
                $check = InventoryLevel::where('inventory_item_id', $form_data['inventory_item_id'])->where('store_id', $form_data['store_id'])->first();
                if($check){
                    return response()->json(['error'=> ['Only one level per store allowed']]);
                }else{
                    $res=InventoryLevel::create($form_data);

                    // Add Activity
                    InventoryActivity::create([
                        'company_id' =>session()->get('company_id'),
                        'inventory_item_id'=>$form_data['inventory_item_id'],
                        'action_date'=>date('Y-m-d'),
                        'action'=>'Adjustment',
                        'document_reference'=>null,
                        'store_id'=>$form_data['store_id'],
                        'down'=>0,
                        'up'=>$form_data['on_hand'],
                    ]);
                    $html = $this->html($res->id);
                    return response()->json(['success'=>$html]);
                }
            }
        }

        public function edit($id){
            $data = InventoryLevel::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                return response()->json([$error->errors()->all()]);
            }else{
                $res = request()->all();
                $data = InventoryLevel::findOrFail($id);
                $data->update($res);
                $html = $this->html($id);
                return response()->json(['success'=>$html]);
            }

        }

        public function validateRules()
        {
            $data =[ 'inventory_item_id'=>'required',
            'store_id'=>'required',
            'on_hand'=>'required',
            'min_order_level'=>'required',
            'min_order_quantity'=>'required',
            ];
            return $data;
        }

        public function destroy($id)
        {
            InventoryLevel::destroy($id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }

        public function html($id)
        {
            // Add security
            $res = InventoryLevel::with('store')->findOrFail($id);

            $html = '<tr id="inv_opt_r_'.$res->id.'">
            <td>'.$res->store->name.'</td>
            <td class="text-center">'.$res->on_hand.'</td>
            <td class="text-center">'.$res->min_order_level.'</td>
            <td class="text-center">'.$res->min_order_quantity.'</td>
            <td><select class="inv_lev_action form-select" id="inv_lev_'.$res->inventory_item_id.'_'.$res->id.'"><option value="">'. __('global.select').'</option><option value="Edit">'. __('global.edit').'</option></select></td></tr>';
            return $html;
        }
}
