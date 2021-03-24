<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
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

    public function index()
    {
        return view('dashboard');
    }

    public function profile()
    {
        $id=\Auth::id();
        $user = DB::table('users')->where('id', $id)->get();
        $companies = DB::table('company_user')->where('user_id', $id)
        ->join('companies', 'companies.id', '=', 'company_id')
        ->select('companies.trading_name')
        ->get();

        return view('setup.user_profile', compact('user', 'companies'));
    }
}
