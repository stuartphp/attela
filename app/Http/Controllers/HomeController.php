<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companies = DB::table('company_user')->where('user_id',\auth()->id())
            ->join('companies', 'companies.id', '=', 'company_id')
            ->pluck('trading_name','companies.id');
        return view('home', compact('companies'));
    }
    public function selection($id)
    {

        $company = DB::table('companies')
            ->join('setup_accounting', 'company_id', '=', 'companies.id')
            ->where('company_id', $id)
            ->first();
        session()->put('company_id', $id);
        session()->put('trading_name', $company->trading_name);
        session()->put('financial_year', $company->financial_year);
        session()->put('financial_period', $company->financial_period);

        // Get permissions
        $id =\Auth::id();

        $roles = DB::table('role_user')->where('user_id', $id)
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
        ->first();

        $per = explode(',', $roles->permissions);
        session()->put('grant',$per);


        return redirect('dashboard');
    }
}
