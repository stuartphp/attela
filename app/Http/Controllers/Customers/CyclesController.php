<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerCycle;
use Validator;
class CyclesController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'customer_cycles_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search))
            {
                $data = CustomerCycle::whereHas('customers', function ($q){
                    $q->where('company_id', session()->get('company_id'));
                })->where(function($q) use($search){
                    $q->where('activity', 'like', "%$search%");
                })
                ->paginate(15);

            }else{
                $data = CustomerCycle::whereHas('customers', function ($q){ $q->where('company_id', session()->get('company_id'));})->paginate(15);
            }
            return view('customers.cycles', compact('data', 'search'));

        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());

            if($error->fails())
            {
                return response()->json(['errors'=>$error->errors()->all()]);
            }

            $form_data = request()->all();

            CustomerCycle::create($form_data);
            return response()->json(['success'=>'yes']);
        }

        public function edit($id){
            $data = CustomerCycle::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                return response()->json(['error'=>$error->errors()->all()]);
            }else{
                $res = request()->all();
                $data = CustomerCycle::findOrFail($id);
                $data->update($res);
                $html = $this->html($id);
                return response()->json(['success'=>$html]);
            }

        }

        public function validateRules()
        {
            $data =[
            'activity'=>'required',
            'time'=>'required',
            'frequency'=>'required',
            ];
            return $data;
        }

        public function destroy($id)
        {
            CustomerCycle::destroy($id);
            return response()->json(['success'=>'yes']);
        }
        public function html($id)
        {
            // Add security
            $res = CustomerContact::findOrFail($id);

            $html = '<tr id="cus_cyc_r_'.$res->id.'">
            <td>'.$res->activity.'</td>
            <td>'.$res->time.'</td>
            <td>'.$res->frequency.'</td>
            <td><select class="cus_cyc_action form-select" id="cus_cyc_'.$res->customer_id.'_'.$res->id.'"><option value="">'. __('global.select').'</option><option value="Edit">'. __('global.edit').'</option><option value="Delete">'.__('global.delete').'</option></select></td></tr>';
            return $html;
        }
}
