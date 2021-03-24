<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use DataTables;
use Validator;

class PermissionsController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'permissions_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return redirect('dashboard');
            }
            return view('user-management.permissions');

        }
        public function get_data()
        {
            if (request()->ajax()) {
                $data = Permission::get();
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

            Permission::create($form_data);
            return response()->json(['success'=>'yes']);
        }

        public function edit($id){
            $data = Permission::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){
            $res = request()->all();
            $data = Permission::findOrFail($id);
            $data->update($res);
            return response()->json('success');
        }

        public function validateRules()
        {
            $data =[ 'group'=>'required',
'title'=>'required',
 ];
            return $data;
        }

        public function destroy($id)
        {
            Permission::destroy($id);
            return response()->json(['success'=>'yes']);
        }
}
