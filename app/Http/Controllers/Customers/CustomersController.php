<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerContact;
use App\Models\CustomerCycle;
use Validator;

class CustomersController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'customers_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $search = request('search');
            if(!empty($search))
            {
                $data = Customer::where('company_id', session()->get('company_id'))
                ->where(function($q) use($search){
                    $q->where('account_number', 'like', "%$search%")
                        ->orWhere('description', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('telephone', 'like', "%$search%")
                        ->orWhere('contact_person', 'like', "%$search%");
                })
                ->paginate(17);
            }else{
                $data = Customer::where('company_id', session()->get('company_id'))
                ->paginate(17);
            }
            return view('customers.customers', compact('data', 'search'));

        }

        public function create()
        {
            $data = (object) [];
            $currencies = Country::pluck('name', 'iso_code_3')->toArray();
            return view('customers.form_customers', compact('data','currencies'));
        }

        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                return response()->json(['error'=>$error->errors()->all()]);
            }else{
                $form_data = request()->all();
                $form_data['company_id']=session()->get('company_id');
                $form_data['is_open_item']=request()->get('is_open_item')?1:0;
                $form_data['accept_electronic_document']=request()->get('accept_electronic_document')?1:0;
                $form_data['is_active']=request()->get('is_active')?1:0;
                $id =Customer::create($form_data);

                return response()->json(['success'=>$id->id]);
            }
        }

        public function edit($id){
            $data = Customer::findOrFail($id);
            return response()->json(['data'=>$data]);
        }
        public function show($id)
        {
            $data = Customer::findOrFail($id);
            $contacts = CustomerContact::where('customer_id', $id)->get();
            $currencies = Country::pluck('name', 'iso_code_3')->toArray();
            $cycles = CustomerCycle::where('customer_id', $id)->get();
            return view('customers.detail', compact('data', 'contacts', 'currencies', 'cycles'));
        }

        public function update($id){
            //dd(request()->all());
            $error = Validator::make(\request()->all(), $this->validateRules());
            if($error->fails())
            {
                return response()->json(['error'=>$error->errors()->all()]);
            }else{
                $form_data = request()->all();
                $data = Customer::findOrFail($id);
                $form_data['is_open_item']=request()->get('is_open_item')?1:0;
                $form_data['accept_electronic_document']=request()->get('accept_electronic_document')?1:0;
                $form_data['is_active']=request()->get('is_active')?1:0;
                $data->update($form_data);
                return response()->json(['success'=>['is_active'=>$form_data['is_active']]]);
            }
        }

        public function validateRules()
        {
            $data =[
            'account_number'=>'required',
            'description'=>'required',
            'contact_person'=>'required',
            'physical_address1'=>'required',
            'physical_city' =>'required',
            'physical_province' =>'required',
            'physical_country' =>'required',
            'delivery_address1' =>'required',
            'delivery_city' =>'required',
            'delivery_province' =>'required',
            'delivery_country' =>'required',
            'email'=>'required',
            'payment_terms'=>'required',
            'default_tax'=>'required',
            ];
            return $data;
        }

        public function destroy($id)
        {
            Customer::destroy($id);
            session()->flash('success', __('global.record_deleted'));
            return redirect()->back();
        }

}
