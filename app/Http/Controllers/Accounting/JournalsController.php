<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Journal;
use DataTables;
use Validator;


class JournalsController extends Controller
{


    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'journals_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect()->back();
            }
            $data = Journal::whereIn('company_id', [0,session()->get('company_id')])->paginate(15);
            return view('accounting.journals', compact('data'));

        }
        
        public function store(){
            $error = Validator::make(\request()->all(), $this->validateRules());

            if($error->fails())
            {
                return response()->json(['errors'=>$error->errors()->all()]);
            }

            $form_data = request()->all();

            Journal::create($form_data);
            return response()->json(['success'=>'yes']);
        }

        public function edit($id){
            $data = Journal::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = Journal::findOrFail($id);
            $data->update($res);
            return response()->json('success');
        }

        public function validateRules()
        {
            $data =[ 'company_id'=>'required',
'group'=>'required',
'name'=>'required',
'code'=>'required',
 ];
            return $data;
        }

        public function destroy($id)
        {
            Journal::destroy($id);
            return response()->json(['success'=>'yes']);
        }
}
