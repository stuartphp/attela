<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryOption;
use Validator;

class InventoryOptionsController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'inventory_options_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search))
            {
                $data = InventoryOption::whereHas('items', function ($q) use($search){
                    $q->where('company_id', session()->get('company_id'))
                    ->where('item_code', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('unit', 'like', "%$search%");
                })->paginate(15);
            }else{
                $data = InventoryOption::whereHas('items', function ($q){
                    $q->where('company_id', session()->get('company_id'));
                })->paginate(15);
            }
            return view('inventory.options', compact('data', 'search'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                return response()->json([$error->errors()->all()]);
            }else{
                $form_data = request()->all();
                $id =InventoryOption::create($form_data);
                $html = $this->html($id->id);
                return response()->json(['success'=>$html]);
            }
        }

        public function edit($id){
            $data = InventoryOption::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                return response()->json([$error->errors()->all()]);
            }else{
                $res = request()->all();
                $data = InventoryOption::findOrFail($id);
                $data->update($res);
                $html = $this->html($id);
                return response()->json(['success'=>$html]);
            }
        }

        public function validateRules()
        {
            $data =[ 'inventory_item_id'=>'required',
            'name'=>'required',
            ];
            return $data; 
        }

        public function destroy($id)
        {
            InventoryOption::destroy($id);
            return response()->json(['success'=>'yes']);
        }

        public function html($id)
        {
            // Add security
            $res = InventoryOption::findOrFail($id);

            $html = '<tr id="inv_opt_r_'.$res->id.'">
            <td>'.$res->name.'</td>
            <td>'.$res->value.'</td>
            <td><select class="inv_opt_action form-select" id="inv_opt_'.$res->inventory_item_id.'_'.$res->id.'"><option value="">'. __('global.select').'</option><option value="Edit">'. __('global.edit').'</option><option value="Delete">'.__('global.delete').'</option></select></td></tr>';
            return $html;
        }
}
