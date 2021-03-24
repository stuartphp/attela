<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Counter;
use DataTables;
use Validator;
class CountersController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'Counter_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $data = Counter::where('company_id', session()->get('company_id'))->orderBy('name')->get();
            return view('setup.counters', compact('data'));

        }
        
        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());

            if($error->fails())
            {
                return response()->json(['errors'=>$error->errors()->all()]);
            }

            $form_data = request()->all();

            Counter::create($form_data);
            return response()->json(['success'=>'yes']);
        }

        public function edit($id){
            $data = Counter::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = Counter::findOrFail($id);
            $data->update($res);
            session()->flash('success', __('global.record_updated'));
            return redirect()->back();
        }

        public function validateRules()
        {
            $data =[ 'company_id'=>'required',
'name'=>'required',
'number'=>'required',
 ];
            return $data;
        }

        public function destroy($id)
        {
            Counter::destroy($id);
            return response()->json(['success'=>'yes']);
        }
}
