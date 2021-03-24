<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerContact;
use Validator;
class ContactsController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'customer_contacts_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search))
            {
                $data = CustomerContact::with(['customers'])->whereHas('customers', function ($q){
                    $q->where('company_id', session()->get('company_id'));
                })->where(function($q) use($search){
                    $q->where('name', 'like', "%$search%")
                        ->orWhere('mobile', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('telephone', 'like', "%$search%");
                })
                ->paginate(15);

            }else{
                $data = CustomerContact::with(['customers'])->whereHas('customers', function ($q){ $q->where('company_id', session()->get('company_id'));})->paginate(15);
            }
            return view('customers.contacts', compact('data', 'search'));

        }
        public function get_data()
        {
            if (request()->ajax()) {
                $data = CustomerContact::whereHas('customers', function ($q){ $q->where('company_id', session()->get('company_id'));})->get();
                return Datatables::of($data)
                    ->editColumn('customer_id', function ($row){
                        return isset($row->customers->description)?$row->customers->description:'';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());

            if($error->fails())
            {
                return response()->json(['errors'=>$error->errors()->all()]);
            }else{
                $form_data = request()->all();
                
                $id = CustomerContact::create($form_data);
                $html = $this->html($id->id);
                return response()->json(['success'=>$html]);
            }


            return response()->json(['success'=>'yes']);
        }

        public function edit($id){
            $data = CustomerContact::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                return response()->json([$error->errors()->all()]);
            }else{
                $res = request()->all();
                $data = CustomerContact::findOrFail($id);
                $data->update($res);
                $html = $this->html($id);
                return response()->json(['success'=>$html]);
            }
        }

        public function validateRules()
        {
            $data =[
'name'=>'required',
 ];
            return $data;
        }

        public function destroy($id)
        {
            CustomerContact::destroy($id);
            return response()->json(['success'=>'yes']);
        }
        public function html($id)
        {
            // Add security
            $res = CustomerContact::findOrFail($id);

            $html = '<tr id="cus_con_r_'.$res->id.'">
            <td>'.$res->name.'</td>
            <td>'.$res->job_title.'</td>
            <td>'.$res->email.'</td>
            <td>'.$res->mobile.'</td>
            <td>'.$res->telephone.'</td>
            <td><select class="cus_con_action form-select" id="cus_con_'.$res->customer_id.'_'.$res->id.'"><option value="">'. __('global.select').'</option><option value="Edit">'. __('global.edit').'</option><option value="Delete">'.__('global.delete').'</option></select></td></tr>';
            return $html;
        }
}
