<?php

namespace App\Http\Controllers\Suppliers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Validator;
class SuppliersController extends Controller
{
    public function index()
    {
        if(count(array_intersect(session()->get('grant'), ['SU', 'suppliers_access']))==0)
        {
            session()->flash('error', __('global.access_denied'));
            return redirect()->back();
        }
        $search = request('search');
        if(!empty($search))
        {
            $data = Supplier::where('company_id', session()->get('company_id'))
            ->where(function($q) use($search){
                $q->where('account_number', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('telephone', 'like', "%$search%")
                    ->orWhere('contact_person', 'like', "%$search%");
            })
            ->paginate(15);
        }else{
            $data = Supplier::where('company_id', session()->get('company_id'))
            ->paginate(15);
        }
        return view('suppliers.suppliers', compact('data', 'search'));

    }

    public function store(){
        $error = Validator::make(\request()->all(), $this->validateRules());

        if($error->fails())
        {
            return response()->json(['errors'=>$error->errors()->all()]);
        }

        $form_data = request()->all();
        $form_data['is_open_item']=request()->get('is_open_item')?1:0;
        $form_data['is_active']=request()->get('is_active')?1:0;
        Supplier::create($form_data);
        return response()->json(['success'=>'yes']);
    }

    public function edit($id){
        $data = Supplier::findOrFail($id);
        return response()->json(['data'=>$data]);
    }

    public function update($id){
        $form_data = request()->all();
        $form_data['is_open_item']=request()->get('is_open_item')?1:0;
        $form_data['is_active']=request()->get('is_active')?1:0;
        $data = Supplier::findOrFail($id);
        $data->update($form_data);
        return response()->json('success');
    }

    public function show($id)
    {
        $data = Supplier::findOrFail($id);
        return view('suppliers.detail', compact('data'));
    }

    public function validateRules()
    {
        $data =[ 'company_id'=>'required',
'account_number'=>'required',
'description'=>'required',
'current_balance'=>'required',
'currency_code'=>'required',
'payment_terms'=>'required',
'default_tax'=>'required',
'is_open_item'=>'required',
'is_active'=>'required',
];
        return $data;
    }

    public function destroy($id)
    {
        Supplier::destroy($id);
        return response()->json(['success'=>'yes']);
    }
}
