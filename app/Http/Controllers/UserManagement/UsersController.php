<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CompanyUser;
use Validator;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        if(count(array_intersect(session()->get('grant'), ['SU', 'user_access']))==0)
        {
            session()->flash('error', __('global.access_denied'));
            return redirect()->back();
        }
        $data = User::get();
        return view('user-management.users', compact('data'));
    }

    public function store(){
        $error = Validator::make(\request()->all(), $this->validateRules());

        if($error->fails())
        {
            return response()->json(['errors'=>$error->errors()->all()]);
        }

        $form_data = request()->all();
        $form_data['password']= Hash::make($form_data['password']);
        $user =User::create($form_data);
        CompanyUser::create(['company_id'=>session()->get('company_id'), 'user_id'=>$user->id]);
        return response()->json(['success'=>'yes']);
    }

    public function edit($id){
        $data = User::findOrFail($id);
        return response()->json(['data'=>$data]);
    }

    public function update($id){
        $res = request()->all();
        $password = request()->input('password');
        if(isset($password) && $password>'')
        {
            $res['password'] = Hash::make($password);
        }else{
            unset($res['password']);
        }

        $data = User::findOrFail($id);
        $data->update($res);
        return response()->json('success');
    }

    public function validateRules()
    {
        $data =[ 'name'=>'required',
        'email'=>'required',
        'contact_number'=>'required',
        'is_active'=>'required', ];
        return $data;
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['success'=>'yes']);
    }
}
