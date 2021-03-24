<?php

namespace App\Http\Controllers\Suppliers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupplierItem;
use DataTables;
use Validator;
class ItemsController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'supplier_items_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            return view('suppliers.items');

        }
        public function get_data()
        {
            if (request()->ajax()) {
                $data = SupplierItem::get();
                return Datatables::of($data)
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());

            if($error->fails())
            {
                return response()->json(['errors'=>$error->errors()->all()]);
            }

            $form_data = request()->all();

            SupplierItem::create($form_data);
            return response()->json(['success'=>'yes']);
        }

        public function edit($id){
            $data = SupplierItem::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = SupplierItem::findOrFail($id);
            $data->update($res);
            return response()->json('success');
        }

        public function validateRules()
        {
            $data =[ 'supplier_id'=>'required',
'description'=>'required',
'unit'=>'required',
'currency'=>'required',
'tax_code'=>'required',
'price_excl'=>'required',
'price_incl'=>'required',
 ];
            return $data;
        }

        public function destroy($id)
        {
            SupplierItem::destroy($id);
            return response()->json(['success'=>'yes']);
        }
}
