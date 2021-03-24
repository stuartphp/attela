<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use DataTables;
use Validator;

class RolesController extends Controller
{
    public function index()
        {
            if(count(array_intersect(session()->get('grant'), ['SU', 'roles_access']))==0)
            {
                session()->flash('error', __('global.access_denied'));
                return false;
            }
            $permissions = Permission::all()->pluck('title', 'title');
            return view('user-management.roles', compact('permissions'));

        }
        public function get_data()
        {
            if (request()->ajax()) {
                $data = Role::where('company_id', session()->get('company_id'))->get();
                return Datatables::of($data)
                ->editColumn('permissions', function($row){
                    $per = str_replace('_', ' ', $row->permissions);
                    $per = str_replace(',', ', ', $per);
                    return ucwords($per);
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
            }

            $form_data = request()->all();
            $form_data['permissions']=implode(',', request()->get('permissions'));

            Role::create($form_data);
            return response()->json(['success'=>'yes']);
        }

        public function edit($id){
            $data = Role::findOrFail($id);
            return response()->json(['data'=>$data]);
        }

        public function update($id){

            $res = request()->all();

            $data = Role::findOrFail($id);

            $res['permissions']=implode(',', $res['permissions']);
            $data->update($res);
            return response()->json('success');
        }

        public function validateRules()
        {
            $data =[ 'company_id'=>'required',
                'name'=>'required',
                'permissions'=>'required|array',
            ];
            return $data;
        }

        public function destroy($id)
        {
            Role::destroy($id);
            return response()->json(['success'=>'yes']);
        }
}
